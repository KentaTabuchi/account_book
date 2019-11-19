echo "<p>webhook start！</p>";
exec('cd /home/アカウント名/www/gitpullしていたディレクトリ名/',$op);
print_r($op); 
exec('git pull');
echo "<p>webhook finish</p>";