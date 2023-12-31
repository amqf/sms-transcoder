## About

This is a command line project to transcode a file content resulted by a AT+CMGL command executed into a modem GSM to a JSON format.

### Continuous Integration

The pipeline configuration includes test stage to execute integration test with PHPUnit on Gitlab CI (with .gitlab-ci.yml).

### Directory structure

```bash
./src
|
|_Decoders
| |_GSMDecoder.php
|
|_Encoders
| |_JSONEncoder_.php
|
|_InputDataDecoder.php
|_OutputDataEncoder.php
|_Transcoder.php
```

## Usage

### Without Docker

For run without docker make sure you have installed on host these dependencies:

- php8.1
- php8.1-dom (used by phpunit)
- php8.1-mbstring (used by phpunit)
- php8.1-curl (used for improve composer performance)

```bash
# setup
composer install

# test execution
composer test

# run
php index.php < sms.example
```

### With Docker

Docker was used for just help transcode a file, no run tests.

```bash
# setup
docker build -t faturasimples/smstranscoder .

# run
docker run -i --rm --name faturasimples_smstranscoder faturasimples/smstranscoder < sms.example
```

## Output

If used `sms.example` file from root directory, then expected output after run command line project with or without docker is:

```
[{"seq":"1","status":"REC READ","from":"+5511388382882","timestamp":"22/05/05 16:04:23+08","text":"00480065006C006C006F00200077006F0072006C0064002000C1"},{"seq":"2","status":"REC UNREAD","from":"+5511388382882","timestamp":"22/05/10 13:54:14+08","text":"Essa eh a segunda mensagem"},{"seq":"3","status":"REC UNREAD","from":"+551130872258","timestamp":"22/05/30 19:37:01+08","text":"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam..."}]
```
