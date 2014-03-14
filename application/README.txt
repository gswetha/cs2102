to access a controller, eg. blog controller go to this URL:

http://localhost/cs2102/index.php/blog/details/123

for connecting to oracle:
So, this is what worked for me:

Do you have Oracle Instant Client? If not get it.
Do you have the Oracle SDK? If not get it.
Unzip instantclient.
Unzip the SDK into a sub-directory
Add ORACLE_HOME as an exported command line variable ($ORACLE_HOME in *nix, %ORACLE_HOME% in win). Have it point to the fully-qualified path to the above instantclient folder.
Create ORACLE_BIN and have it point to the SDK.
Add ORACLE_HOME to your PATH.
Restart Apache...