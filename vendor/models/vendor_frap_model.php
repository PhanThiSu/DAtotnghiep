<?php
class vendor_frap_model extends vendor_fra_model {
	public function allp($fields='*', $options=null) {
		$pagination = [];
		$resultMObject = parent::getAllRecordsLimit($fields, $options);
		$pagination['data'] = [];
		if($resultMObject) {
			while($row = $resultMObject->fetch_assoc()) {
	    		$pagination['data'][] = $row;
	    	}
		}
		$pagination['norecords']= parent::getCountRecords($options);
		$pagination['nocurp'] 	= count($pagination['data']);
		$pagination['curp'] 	= $this->curp;
		$pagination['nopp'] 	= $this->nopp;
		return $pagination;
	}

	/*
	public function allhrp($fields='*', $options=null) {
		$pagination = [];
		$resultMObject = parent::getAllRecordsLimitHasRelationship($fields, $options);
		$pagination['data'] = [];
		if($resultMObject) {
			while($row = $resultMObject->fetch_assoc()) {
	    		$pagination['data'][] = $row;
	    	}
		}
		$pagination['norecords']= parent::getCountRecords();
		$pagination['nocurp'] 	= count($pagination['data']);
		$pagination['curp'] 	= $this->curp;
		$pagination['nopp'] 	= $this->nopp;
		return $pagination;
	}
	*/
}
?>
