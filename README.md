# UrlMonitor
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/fgluecks/UrlMonitor/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/fgluecks/UrlMonitor/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/fgluecks/UrlMonitor/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/fgluecks/UrlMonitor/?branch=master)
[![Build Status](https://scrutinizer-ci.com/g/fgluecks/UrlMonitor/badges/build.png?b=master)](https://scrutinizer-ci.com/g/fgluecks/UrlMonitor/build-status/master)
[![Code Intelligence Status](https://scrutinizer-ci.com/g/fgluecks/UrlMonitor/badges/code-intelligence.svg?b=master)](https://scrutinizer-ci.com/code-intelligence)

## Useage

#### Syntax
```
php UrlMonitor.php <Domain>
```
#### Example
```
php UrlMonitor.php https://github.com
```

## Curl response definition

### CURLINFO_HTTP_CODE
Time from start until name resolving completed.

### CURLINFO_NAMELOOKUP_TIME
Time from start until name resolving completed

### CURLINFO_CONNECT_TIME
Time from start until remote host or proxy completed

### CURLINFO_APPCONNECT_TIME
Time from start until SSL/SSH handshake completed

### CURLINFO_PRETRANSFER_TIME
Time from start until just before the transfer begins

### CURLINFO_STARTTRANSFER_TIME
Time from start until just when the first byte is received

### CURLINFO_TOTAL_TIME
Total time of previous transfer.

### CURLINFO_SPEED_DOWNLOAD
Average download speed in bytes/sec.
