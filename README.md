# maxitech
Install:
docker stop $(docker ps -a -q)
docker rm $(docker ps -a -q)
cd docker
docker-compose up
