<?php
class dashboard_model extends  vendor_frap_model
{
    	/* backup the db OR just a table */
	public function backup_tables($tables = '*'){
		$return = "";
		$date_string   = date("Y-m-d");
		$database_name = DB_NAME;
		define("BACKUP_PATH", RootURI."media/backup/");

		$this->con =  new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
		if(mysqli_connect_error()) {
			echo "Failed to connect to MySQL". mysqli_connect_error();exit();
		}
		
		//get all of the tables
		if($tables == '*'){
			$tables = array();
			$result = mysqli_query($this->con,"SHOW TABLES");
			while($row = mysqli_fetch_row($result))
			{
				$tables[] = $row[0];
			}
		} else {
			$tables = is_array($tables) ? $tables : explode(',',$tables);
		}
		
		//cycle through
		foreach($tables as $table) {
			$result = mysqli_query($this->con,'SELECT * FROM '.$table);
			$num_fields = mysqli_num_fields($result);
			$num_rows = mysqli_num_rows($result);
			
			$return.= 'DROP TABLE IF EXISTS '.$table.';';
			$row2 = mysqli_fetch_row(mysqli_query($this->con,'SHOW CREATE TABLE '.$table));
			$return.= "\n\n".$row2[1].";\n\n";
			$counter = 1;

			//Over tables
			for ($i = 0; $i < $num_fields; $i++) {   
				while($row = mysqli_fetch_row($result)) 
				{   
					if($counter == 1){
						$return.= 'INSERT INTO '.$table.' VALUES(';
					} else {
						$return.= '(';
					}
		
					//Over fields
					for($j=0; $j<$num_fields; $j++) {
						$row[$j] = addslashes($row[$j]);
						$row[$j] = str_replace("\n","\\n",$row[$j]);
						if (isset($row[$j])) { $return.= '"'.$row[$j].'"' ; } else { $return.= '""'; }
						if ($j<($num_fields-1)) { $return.= ','; }
					}
		
					if($num_rows == $counter){
						$return.= ");\n";
					} else {
						$return.= "),\n";
					}
					++$counter;
				}
			}
			$return.="\n\n\n";
		
		}
		
		//save file
		$handle = fopen(BACKUP_PATH."db_backup_{$date_string}_{$database_name}.sql",'w+');
		fwrite($handle,$return);

		if(fclose($handle)){
			return true;
		} else return false;
    }
    
	public function backup_zip($tables = '*'){
		$return = "";
		$dashboardUrl = RootURL."admin/dashboard";
		$date_string   = date("Y-m-d");
		$database_name = DB_NAME;
		define("BACKUP_PATH", RootURI."media/backup/");

		$this->con =  new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
		if(mysqli_connect_error()) {
			echo "Failed to connect to MySQL". mysqli_connect_error();exit();
		}
		
		//get all of the tables
		if($tables == '*')
		{
			$tables = array();
			$result = mysqli_query($this->con,"SHOW TABLES");
			while($row = mysqli_fetch_row($result))
			{
				$tables[] = $row[0];
			}
		}
		else
		{
			$tables = is_array($tables) ? $tables : explode(',',$tables);
		}
		
		//cycle through
		foreach($tables as $table)
		{
			$result = mysqli_query($this->con,'SELECT * FROM '.$table);
			$num_fields = mysqli_num_fields($result);
			$num_rows = mysqli_num_rows($result);
			
			
			$return.= 'DROP TABLE IF EXISTS '.$table.';';
			$row2 = mysqli_fetch_row(mysqli_query($this->con,'SHOW CREATE TABLE '.$table));
			$return.= "\n\n".$row2[1].";\n\n";
			
			$counter = 1;

			//Over tables
			for ($i = 0; $i < $num_fields; $i++) 
			{   //Over rows
				while($row = mysqli_fetch_row($result))
				{   
					if($counter == 1){
						$return.= 'INSERT INTO '.$table.' VALUES(';
					} else{
						$return.= '(';
					}
		
					//Over fields
					for($j=0; $j<$num_fields; $j++) 
					{
						$row[$j] = addslashes($row[$j]);
						$row[$j] = str_replace("\n","\\n",$row[$j]);
						if (isset($row[$j])) { $return.= '"'.$row[$j].'"' ; } else { $return.= '""'; }
						if ($j<($num_fields-1)) { $return.= ','; }
					}
		
					if($num_rows == $counter){
						$return.= ");\n";
					} else{
						$return.= "),\n";
					}
					++$counter;
				}
			}
			$return.="\n\n\n";
		
        }
        
		$zip_path = BACKUP_PATH."db_backup_{$date_string}_{$database_name}.zip"; 
        $file = BACKUP_PATH."db_backup_{$date_string}_{$database_name}.sql"; 

        $zip = new ZipArchive();
        if ($zip->open($zip_path, ZipArchive::CREATE) === TRUE){
            $zip->addFromString(basename($file),$return );
            if($zip->close()){
                return true;
            } else return false;
        }

	}
}
?>