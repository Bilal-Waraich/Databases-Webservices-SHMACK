import re
import os
from datetime import datetime
from collections import defaultdict
import matplotlib.pyplot as plt
import matplotlib.dates

BASE_URL = "/~wbilal/"

# Function to read log files
def read_log_file(file_path):
    with open(file_path, 'r') as f:
        for line in f:
            yield line

def parse_apache_access_logs(log_file_path):
    access_pattern = re.compile(r'(?P<ip>[\d\.]+) - - \[(?P<timestamp>.*?)\] "(?P<request>.*?)" (?P<status>\d+) (?P<size>\d+) "(?P<referrer>.*?)" "(?P<user_agent>.*?)"')
    access_stats = defaultdict(lambda: {'count': 0, 'timestamps': [], 'browsers': set()})

    for line in read_log_file(log_file_path):
        match = access_pattern.match(line)
        if match:
            ip = match.group('ip')
            timestamp = match.group('timestamp')
            request = match.group('request')
            status = match.group('status')
            user_agent = match.group('user_agent')

            # Filter entries related to `BASE_URL`
            if BASE_URL in request:
                timestamp = datetime.strptime(timestamp, '%d/%b/%Y:%H:%M:%S %z')
                access_stats[request]['count'] += 1
                access_stats[request]['timestamps'].append(timestamp)
                access_stats[request]['browsers'].add(user_agent)

    return access_stats

def parse_apache_error_logs(log_file_path):
    error_pattern = re.compile(r'\[(.*?)\] \[.*?\] \[.*?\] \[client (?P<ip>[\d\.]+):.*?\] (?P<error_message>.*?)(, referer: (?P<referer>.*))?$')
    error_stats = defaultdict(lambda: {'count': 0, 'messages': [], 'timestamps': []})

    for line in read_log_file(log_file_path):
        match = error_pattern.match(line)
        if match:
            timestamp = match.group(1)
            ip = match.group('ip')
            error_message = match.group('error_message')

            # Filter for `BASE_URL` or `wbilal` in error messages
            if BASE_URL in error_message or 'wbilal' in error_message:
                timestamp = datetime.strptime(timestamp, '%a %b %d %H:%M:%S.%f %Y')
                error_stats[ip]['count'] += 1
                error_stats[ip]['messages'].append(error_message)
                error_stats[ip]['timestamps'].append(timestamp)

    return error_stats

def plot_timeline(timestamps, title):
    sorted_timestamps = sorted(timestamps)  # Sort timestamps
    date_numbers = matplotlib.dates.date2num(sorted_timestamps)  # Convert timestamps to a format matplotlib can handle

    plt.plot_date(date_numbers, range(len(sorted_timestamps)), 'o-', label=title, linestyle='-')
    plt.gcf().autofmt_xdate()
    plt.title(title)
    plt.xlabel('Timestamp')
    plt.ylabel('Count')
    plt.legend()
    plt.tight_layout()
    plt.show()

if __name__ == "__main__":
    # Define paths to your logs
    access_log_path = "/var/log/apache2/access.log"  
    error_log_path = "/var/log/apache2/error.log"  

    # Parse access and error logs
    access_stats = parse_apache_access_logs(access_log_path)
    error_stats = parse_apache_error_logs(error_log_path)

    # Access log statistics and plotting
    print("Access Log Stats:")
    for page, stats in access_stats.items():
        print(f"Page: {page}, Access Count: {stats['count']}, Unique Browsers: {len(stats['browsers'])}")
        plot_timeline(stats['timestamps'], f"Access Timeline - {page}")

    # Error log statistics and plotting
    print("\nError Log Stats:")
    for ip, stats in error_stats.items():
        print(f"IP: {ip}, Error Count: {stats['count']}, Messages: {', '.join(stats['messages'])}")
        plot_timeline(stats['timestamps'], f"Error Timeline - {ip}")