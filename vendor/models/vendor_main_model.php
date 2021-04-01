<?php
class vendor_main_model {
	protected $con;
	protected $table;
	public $nopp = 20;
	public $curp = 1;
	public $errors = false;
    private static $instance = null;

	public function __construct(){
		global $app;
		if(isset($app['prs']['p'])) $this->curp = $app['prs']['p'];
		
		/*
		$this->con =  new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
		if(mysqli_connect_error()) {
			echo "Failed to connect to MySQL". mysqli_connect_error();exit();
		}
		*/
		$instanceDB = vendor_connectdb_model::getInstance();
		$this->con = $instanceDB->getConnection();
		if(!$this->table)	$this->setTableName();
	}

	public static function getInstance() {
        if (!self::$instance) {
			$called_class = get_called_class();
            self::$instance = new $called_class();
        }

        return self::$instance;
    }
	
	protected function setTableName($table=null){
		if($table) {
			$this->table=$table;
		} else {
			$cln = get_class($this);
			$clnf = str_split($cln, strrpos($cln, '_'))[0];
			//$this->table = $this->getTableNameFromModelName($clnf);
			$this->table = vendor_noun_util::pluralize($clnf);
		}
	}
	
	/* Old code! Should you vendor_noun_util::pluralize instead of this function */
	public function getTableNameFromModelName($modelName) {
		if (strrpos($modelName,"y")) {
			if ((strrpos($modelName,"y") + 1) == strlen($modelName)) {
				return str_split($modelName, strrpos($modelName, 'y'))[0].'ies'; 
			} 
		}
		return $modelName.'s';
	}
	
	public function getAllFieldsOfTable($tableName) {
		$sql = "SHOW COLUMNS FROM ".$tableName;
		$fields = $this->con->query($sql);
		$result = [];
		while($field = mysqli_fetch_array($fields)) {
    		array_push($result, $field['Field']);
    	}
		return $result;
	}
	
	public function getTableName() {
		return $this->table;
	}

	public function getRecord($id, $fields='*', $options=null) {
		if(is_array($id)) {
			$id = array_key_exists('id', $id)? $id['id']: $id[1];
		}
		$id = vendor_html_helper::processSQLString($id);
		$conditions = ' WHERE '. $this->table.'.id='.$id;
		return $this->getRecordCondition($conditions, $fields, $options);
	}

	public function getRecord1($conditions, $fields='*', $options=null) {
		
		$conditions = ' WHERE '.$conditions;
		return $this->getRecordCondition($conditions, $fields, $options);
	}

	public function getRecordWhere($wheres, $fields='*', $options=null) {
		$conditions = ' WHERE ';
		$i=0;
		foreach ($wheres as $key => $value) {
			$conditions .= (($i)? " AND ":""). $key."='".$value."'";
			$i++;
		}
		return $this->getRecordCondition($conditions, $fields, $options);
	}

	public function getTotal($field, $conditions=null, $table=null) {
		if(!$table)	$table = $this->table;

		$sql = "SELECT SUM($field) as total FROM $table WHERE $conditions";
		$result = $this->con->query($sql);
		if($result) {
			$record = $result->fetch_assoc();
		} else $record=false;
		return $record['total'];
	}

    public static function convertToList($mysqliObject, $valueName) {
    	$arrReturn = [];
    	while($row = mysqli_fetch_array($mysqliObject)) {
    		$arrReturn[$row['id']] = $row[$valueName];
    	}
    	return $arrReturn;
    }

	private function getRecordCondition($conditions, $fields='*', $options=null) {
		$join = '';
		if(isset($this->relationships) && (isset($options['joins']) && $options['joins'])) {
			$joinFields = "";
			foreach($this->relationships as $k=>$rv) {
				if(!vendor_app_util::is_multi_array($rv)) {
					$vtmp = $rv;
					$rv = [];
					$rv[] = $vtmp;
				}
				foreach($rv as $v) {
					if(isset($options['joins']) && !in_array($v[0],$options['joins']))
						continue;
					$joinTable = $this->getTableNameFromModelName($v[0]);
					$joinTableFields = $this->getAllFieldsOfTable($joinTable);
					if($k=="belongTo") {
						foreach ($joinTableFields as $field) {
							$joinFields .= ", ".$joinTable.".".$field." as ".$joinTable."_".$field;
						}
						$join .= " LEFT JOIN ".$joinTable." ON ".$this->table.".".$v['key']."=".$joinTable.".id ";
					} else if($k=="hasMany" && ((isset($options['get-child']) && $options['get-child']) || isset($options['group']))){
						if(!isset($options['group'])) {
							foreach ($joinTableFields as $field) {
								$joinFields .= ", ".$joinTable.".".$field." as ".$joinTable."_".$field;
							}
						}
						$join .= " RIGHT JOIN ".$joinTable." ON ".$this->table.".id=".$joinTable.".".$v['key']." ";
					}
				}
			}
			if($joinFields)	$fields .= $joinFields;
		}
		//$conditions = ' WHERE '. $this->table.'.id='.$id;
		$conditions.= (isset($options['conditions']) && $options['conditions'])? ' AND '.$options['conditions']: "";

		/* Becaful with group */
		$group = "";
		if(isset($options['group'])) {
			$group = "GROUP BY ";
			if (strpos($options['group'], '.') !== false) {
				$group .= $options['group'];
			} else 	$group .= $this->table.".".$options['group'];
		}

		$order = (isset($options['order']))? "ORDER BY ".$options['order']:'';

		$limit = (isset($options['limit']))? "LIMIT ".$options['limit']:"";

		$sql = "SELECT $fields FROM $this->table $join $conditions $group $order $limit";
		// exit($sql);
		$result = $this->con->query($sql);
		if($result) {
			$record = $result->fetch_assoc();
		} else $record=false;
		return $record;
	}

	public function getRecordRelation($id=null, $fields='*', $options=null) {
		if(is_array($id)) {
			$id = array_key_exists('id', $id)? $id['id']: $id[1];
		}

		$join = "";
		if(isset($this->relationships)) {
			$joinFields = "";
			foreach($this->relationships as $k=>$rv) {
				if(!vendor_app_util::is_multi_array($rv)) {
					$vtmp = $rv;
					$rv = [];
					$rv[] = $vtmp;
				}
				foreach($rv as $v) {
					$joinTable = $this->getTableNameFromModelName($v[0]);
					$joinTableFields = $this->getAllFieldsOfTable($joinTable);
					if($k=="belongTo") {
						foreach ($joinTableFields as $field) {
							$joinFields .= ", ".$joinTable.".".$field." as ".$joinTable."_".$field;
						}
						$join .= " LEFT JOIN ".$joinTable." ON ".$this->table.".".$v['key']."=".$joinTable.".id ";
					} else if($k=="hasMany" && isset($options['get-child']) && $options['get-child']) {
						foreach ($joinTableFields as $field) {
							$joinFields .= ", ".$joinTable.".".$field." as ".$joinTable."_".$field;
						}
						$join .= " RIGHT JOIN ".$joinTable." ON ".$this->table.".id=".$joinTable.".".$v['key']." ";
					}
				}
			}
			if($joinFields)
				$fields = $this->table.".*".$joinFields;
		}

		$conditions = '';
		if(isset($options['conditions']) && $options['conditions']) {
			$conditions .= ' and '. $options['conditions'];
		}
		$id = vendor_html_helper::processSQLString($id);
		$sql = "SELECT $fields FROM $this->table $join where $this->table.id=$id $conditions";
		$result = $this->con->query($sql);
		if($result) {
			$record = $result->fetch_assoc();
		} else $record=false;
		return $record;
	}

	public function getAllRecordsArray($fields='*', $options=null) {
		$records = [];
		$resultMObject = $this->getAllRecordsLimit($fields, $options);
		$records['data'] = [];
		if($resultMObject) {
			while($row = $resultMObject->fetch_assoc()) {
	    		$records['data'][] = $row;
	    	}
		}
		//$records['norecords']= $this->getCountRecords($options);
		$records['norecords'] 	= count($records['data']);
		return $records;
	}
	
	public function getAllRecordsLimit($fields='*', $options=null) {
		if($fields=='*') $fields = $this->table.".*";
		$join = "";
		if(isset($this->relationships) && (isset($options['joins']) && $options['joins'])) {
			$joinFields = "";
			foreach($this->relationships as $k=>$rv) {
				if(!vendor_app_util::is_multi_array($rv)) {
					$vtmp = $rv;
					$rv = [];
					$rv[] = $vtmp;
				}
				foreach($rv as $v) {
					if(isset($options['joins']) && !in_array($v[0],$options['joins']))
						continue;
					$joinTable = $this->getTableNameFromModelName($v[0]);
					$joinTableFields = $this->getAllFieldsOfTable($joinTable);
					if($k=="belongTo") {
						// 213->220
						if (isset($options['joins']['joinFields']) && $options['joins']['joinFields']!="*") {
							$explodeStr = (strpos($options['joins']['joinFields'], " "))? ", ": ",";
							$getFieldsArr = explode($explodeStr,$options['joins']['joinFields']);
						} else {
							$getFieldsArr = $joinTableFields;
						}
						foreach ($getFieldsArr as $field) {
							$joinFields .= ", ".$joinTable.".".$field." as ".$joinTable."_".$field;
						}
						$join .= " LEFT JOIN ".$joinTable." ON ".$this->table.".".$v['key']."=".$joinTable.".id ";
					} else if($k=="hasMany" && isset($options['get-child']) && $options['get-child']) {
						foreach ($joinTableFields as $field) {
							$joinFields .= ", ".$joinTable.".".$field." as ".$joinTable."_".$field;
						}
						$join .= " RIGHT JOIN ".$joinTable." ON ".$this->table.".id=".$joinTable.".".$v['key']." ";
					}else if($k=="hasMany" && isset($options['search-left-join']) && $options['search-left-join']) {
						if(isset($options['onlycolumn']) && $options['onlycolumn']){
						}else{
							foreach ($joinTableFields as $field) {
								$joinFields .= ", ".$joinTable.".".$field." as ".$joinTable."_".$field;
							}
						}
						$join .= " LEFT JOIN ".$joinTable." ON ".$this->table.".id=".$joinTable.".".$v['key']." ";
					}
				}
			}
			if($joinFields)	$fields .= $joinFields;
		}
		$conditions = (isset($options['conditions']) && $options['conditions'])? ' where '.$options['conditions']: "";

		if(isset($options['pagination'])) {
			if(isset($options['pagination']['page'])) $this->curp = $options['pagination']['page'];
			if(isset($options['pagination']['nopp'])) $this->nopp = $options['pagination']['nopp'];
		}

		/* Becaful with */
		$group = "";
		if(isset($options['group'])) {
			$group = " GROUP BY ";
			if (strpos($options['group'], '.') !== false) {
				$group .= $options['group'];
			} else 	$group .= $this->table.".".$options['group'];
		}

		$order = " ORDER BY ";
		if(isset($options['order'])) {
			if(substr($options['order'], 0, 1) == '*' ){
				$order .= substr($options['order'], 1);
			}
			else if (strpos($options['order'], '.') !== false) {
				$order .= $options['order'];
			} else 	$order .= $this->table.".".$options['order'];
		} else
			$order .= $this->table.".created DESC";

		$limit = " LIMIT $this->nopp OFFSET ".($this->curp-1)*$this->nopp;
		$sql = "SELECT ".$fields." FROM ".$this->table.$join.$conditions.$group.$order.$limit;
		// exit($sql);
		return $this->con->query($sql);
	}

	/* Need update it with Relationship, group by ( and maybe Limit?) */
	public function getAllRecords($fields='*', $options=null) {
		$join = '';
		if(isset($this->relationships) && (isset($options['joins']) && $options['joins'])) {
			$joinFields = "";
			foreach($this->relationships as $k=>$rv) {
				if(!vendor_app_util::is_multi_array($rv)) {
					$vtmp = $rv;
					$rv = [];
					$rv[] = $vtmp;
				}
				foreach($rv as $v) {
					if(isset($options['joins']) && !in_array($v[0],$options['joins']))
						continue;
					$joinTable = $this->getTableNameFromModelName($v[0]);
					$joinTableFields = $this->getAllFieldsOfTable($joinTable);
					if($k=="belongTo") {
						foreach ($joinTableFields as $field) {
							$joinFields .= ", ".$joinTable.".".$field." as ".$joinTable."_".$field;
						}
						$join .= " LEFT JOIN ".$joinTable." ON ".$this->table.".".$v['key']."=".$joinTable.".id ";
					} else if($k=="hasMany" && isset($options['get-child']) && $options['get-child']) {
						foreach ($joinTableFields as $field) {
							$joinFields .= ", ".$joinTable.".".$field." as ".$joinTable."_".$field;
						}
						$join .= " RIGHT JOIN ".$joinTable." ON ".$this->table.".id=".$joinTable.".".$v['key']." ";
					}
				}
			}
			if($joinFields)	$fields .= $joinFields;
		}
		$conditions = (isset($options['conditions']) && $options['conditions'])? ' where '.$options['conditions']: "";

		/* Becaful with group */
		$group = "";
		if(isset($options['group'])) {
			$group = " GROUP BY ";
			if (strpos($options['group'], '.') !== false) {
				$group .= $options['group'];
			} else 	$group .= $this->table.".".$options['group'];
		}

		$order = " ORDER BY ";
		if(isset($options['order'])) {
			if(substr($options['order'], 0, 1) == '*' ){
				$order .= substr($options['order'], 1);
			}
			else if (strpos($options['order'], '.') !== false) {
				$order .= $options['order'];
			} else 	$order .= $this->table.".".$options['order'];
		} else
			$order .= $this->table.".created DESC";

		$sql = "SELECT ".$fields." FROM ".$this->table.$join.$conditions.$group.$order;
		// if($this->table=="user_month_settings") exit($sql);
		return $this->con->query($sql);
	}

	public function getCountRecords($options=null) {
		$conditions = (isset($options['conditions']) && $options['conditions'])? ' where '.$options['conditions']: "";
		$join = "";
		if(isset($this->relationships) && (isset($options['joins']) && $options['joins'])) {
			$joinFields = "";
			foreach($this->relationships as $k=>$rv) {
				if(!vendor_app_util::is_multi_array($rv)) {
					$vtmp = $rv;
					$rv = [];
					$rv[] = $vtmp;
				}
				foreach($rv as $v) {
					if(isset($options['joins']) && !in_array($v[0],$options['joins']))
						continue;
					$joinTable = $this->getTableNameFromModelName($v[0]);
					$joinTableFields = $this->getAllFieldsOfTable($joinTable);
					if($k=="belongTo") {
						foreach ($joinTableFields as $field) {
							$joinFields .= ", ".$joinTable.".".$field." as ".$joinTable."_".$field;
						}
						$join .= " LEFT JOIN ".$joinTable." ON ".$this->table.".".$v['key']."=".$joinTable.".id ";
					} else if($k=="hasMany" && isset($options['get-child']) && $options['get-child']) {
						foreach ($joinTableFields as $field) {
							$joinFields .= ", ".$joinTable.".".$field." as ".$joinTable."_".$field;
						}
						$join .= " RIGHT JOIN ".$joinTable." ON ".$this->table.".id=".$joinTable.".".$v['key']." ";
					}else if($k=="hasMany" && isset($options['search-left-join']) && $options['search-left-join']) {
						if(isset($options['onlycolumn']) && $options['onlycolumn']){
						}else{
							foreach ($joinTableFields as $field) {
								$joinFields .= ", ".$joinTable.".".$field." as ".$joinTable."_".$field;
							}
						}
						$join .= " LEFT JOIN ".$joinTable." ON ".$this->table.".id=".$joinTable.".".$v['key']." ";
					}
				}
			}
		}
		if(isset($options['group'])) {
			$group = " GROUP BY ";
			if (strpos($options['group'], '.') !== false) {
				$group .= $options['group'];
			} else 	$group .= $this->table.".".$options['group'];
			$query = "SELECT COUNT(*) as total FROM (SELECT ".$options['group']." FROM ".$this->table.$join.$conditions.$group.") AS SUBQUERY";
		}else if(isset($options['total-distinct']) && $options['total-distinct']){
			$query = "SELECT COUNT(DISTINCT ".$this->table.".id) as total FROM ".$this->table.$join.$conditions;
			preg_match('/(.*)(GROUP BY.*)/', $query, $matches);
			$query = $matches[1];
		} else {
			//$query = "SELECT COUNT(*) as total FROM ".$this->table.$conditions;
			$query = "SELECT COUNT(*) as total FROM ".$this->table.$join.$conditions;
		}
		// exit($query);
		$result = $this->con->query($query);
		return $result->fetch_assoc()['total'];
	}

	/** Functions below are rarely used **/	
	public function getAllRecordsLeftJoin($fields=null, $options=null) {
		if(!$fields)	$fields = '*';
		$conditions = '';
		$joins = '';
		if(isset($options['conditions']) && $options['conditions']) {
			$conditions .= ' where '.$options['conditions'];
		}
		if(isset($options['table2'])) {
			$joins .= ' LEFT JOIN '.$options['table2'].' AS b'.' ON '.$options['column1'].'='.$options['column2'];
			if(isset($options['table3'])) {
				$joins .= ' LEFT JOIN '.$options['table3'].' AS c'.' ON '.$options['column2_3'].'='.$options['column3'];
			}
		}
		$query = "SELECT ".$fields." FROM ".$this->table.' AS a'.$joins.$conditions.'  GROUP BY a.id ORDER BY a.id DESC';
		$result = $this->con->query($query);
		return $result;
	}
}
?>
