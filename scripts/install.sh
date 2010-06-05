#!/bin/bash





MenuDistros () 
{
    echo "1.- Ubuntu"
    
    echo "2.- Salir"

}

#while true ; 
#do
    MenuDistros
    read Distros
        for Distro in $Distros ; do
    	case "$Distros" in
	    
		
    	    1)
    	        echo "ubuntu" 
    	        
    	        mysql --user=myuser --password=mypass MyDB -e "CREATE DATABASE 'TianguisCabal' DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci; "	
    	        
    	        CREATE USER 'TianguisCabal'@'localhost' IDENTIFIED BY '***';

#GRANT USAGE ON * . * TO 'TianguisCabal'@'localhost' IDENTIFIED BY '***' WITH MAX_QUERIES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0 MAX_UPDATES_PER_HOUR 0 MAX_USER_CONNECTIONS 0 ;

#CREATE DATABASE IF NOT EXISTS `TianguisCabal` ;

#GRANT ALL PRIVILEGES ON `TianguisCabal` . * TO 'TianguisCabal'@'localhost';        
    	    ;;
    	    
    	    2)
    		    echo "Exit"
    		    exit 0 
    	    ;;
	    
	    
    	    *)
    		    echo "Please enter number ONLY ranging from 1-5!"
    		;;
		
    	esac
    done
#done



