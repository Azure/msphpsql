## Setup Environment on a clean machine

The PHP zip file can be downloaded from <http://php.net/downloads.php>.

The SQLSRV and PDO_SQLSRV driver binaries can be downloaded from <https://github.com/Microsoft/msphpsql/releases>.

### Windows
Install Visual Studio 2015 redistributable before running the following commands.
Run `Windows PowerShell` as administrator.

    Set-ExecutionPolicy Unrestricted
    .\setup_env_windows.ps1 <absolute path to the PHP zip file> <absolute path to the SQLSRV driver DLL> <absolute path to the PDO_SQLSRV driver DLL>

### Ubuntu 16
    sudo env "PATH=$PATH" bash setup_env_unix.sh Ubuntu16 <PHP_VERSION - 7.x.y> <PHP_THREAD - ts or nts> <absolute path to the SQLSRV driver so> <absolute path to the PDO_SQLSRV driver so>
### RedHat 7
    sudo env "PATH=$PATH" bash setup_env_unix.sh RedHat7 <PHP_VERSION - 7.x.y> <PHP_THREAD - ts or nts> <absolute path to the SQLSRV driver so> <absolute path to the PDO_SQLSRV driver so>
### MacOS 10.12 Sierra
`brew` cannot be run with `sudo` on Sierra. Either enable passwordless `sudo` on the machine or enter the password when prompted. 

    bash setup_env_unix.sh Sierra <PHP_VERSION - 7.x.y> <PHP_THREAD - ts or nts> <absolute path to the SQLSRV driver so> <absolute path to the PDO_SQLSRV driver so>
## Run benchmarks
PHPBench is used to run the benchmarks. Visit http://phpbench.readthedocs.io/en/latest/introduction.html to have an idea how the tool works.

##### 1. Modify lib/connect.php with the test database credentials
##### 2. Execute run-perf_tests.py

### Windows
    py.exe run-perf_tests.py -platform <PLATFORM> -iterations <ITERATIONS> -iterations-large <ITERATIONS_LARGE> -result-server <RESULT_SERVER> -result-db <RESULT_DB> -result-uid <RESULT_UID> -result-pwd <RESULT_PWD
### Linux and Mac
On Linux and Mac, the script must be executed with `sudo python3` because to enable pooling it needs to modify odbcinst.ini system file. As an improvement, the location of the odbcinst.ini file can be changed so that, sudo is not requiered. 
    
    python3 run-perf_tests.py -platform <PLATFORM> -iterations <ITERATIONS> -iterations-large <ITERATIONS_LARGE> -result-server <RESULT_SERVER> -result-db <RESULT_DB> -result-uid <RESULT_UID> -result-pwd <RESULT_PWD>

`-platform` - The platform that the tests are ran on. Must be one of the following: Windows10, WindowsServer2016, WindowsServer2012, Ubuntu16, RedHat7, Sierra.
`-iterations` - The number of iterations for regular tests.  
`-iterations-large` - The number of iterations for the tests that fetch large data. Usually set to 1.  
`-result-server` - The server containing the result database. It is assumed that the result database s already setup before running the tests.  
`-result-db` - Database name. With the current result database setup files, this should be set to `TestResults`.
`-result-uid` - Result database username.
`-result-pwd` - Result database password. 
