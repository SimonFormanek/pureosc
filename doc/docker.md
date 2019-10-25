vse smazat
  docker system prune --volumes

vytvorit
  docker volume create portainer_data
spustit 
 docker run -dit --restart always -p 9001:9000 -v /var/run/docker.sock:/var/run/docker.sock -v portainer_data:/data portainer/portainer