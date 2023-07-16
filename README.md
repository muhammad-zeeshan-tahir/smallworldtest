
#  Small World Star Movie Restful API Test


## Installation guide for local machine setup

- Step No.  1 : Install Docker and copy 'smallworldtest' folder
- Step No.  2 : Go to CMD and cd 'path directory of folder'
- Step No.  3 : docker-compose build --no-cache --force-rm 
- Step No.  4 : docker-compose up -d 
- Step No.  5 : docker exec smallworldtest bash -c "composer update"
- Step No.  6 : docker exec smallworldtest bash -c "php artisan l5-swagger:generate"
- Step No.  7 : docker exec smallworldtest bash -c "php artisan optimize:clear"
- Step No.  8 : docker exec smallworldtest bash -c "php artisan migrate"
- Step No.  9 : docker exec smallworldtest bash -c "php artisan db:seed"
- Step No. 10 : docker exec smallworldtest bash -c "php artisan test"  for unit testing
- Step No. 11 : Open Browser and open swagger Rest Api for filter and usage http://localhost:3000/api/documentation
