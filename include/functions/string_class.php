<?php	class str{		public function __construct(){					}		public function length($s){			if(preg_match_all( '(.)su', $s ) == strlen($s)){				return (preg_match_all( '(.)su', $s )-1);			}else if(preg_match_all( '(.)su', $s ) == mb_strlen($s,"UTF-8")){				return (preg_match_all( '(.)su', $s ));			}else{				return strlen(utf8_decode($s));			}		}		public function divide($s, $l = 30){			$t = "";			$j=0;			$n = preg_match_all( '(.)su', $s )-1;			for($i=0;$i<=$n; $i++){				if($s[$i] == ' '){					$j=0;					$t .= $s[$i];				}else{					if($j>$l){						$t .= ($s[$i] . '<br/>');						$j=0;					}					else{						$t .= $s[$i];						$j++;					}				}			}			return $t;		}		public function clean($r){				$t = '';				$r = trim($r);				for($i=0; $i<=strlen($r)-1;$i++){					if($r[$i] == "'" || $r[$i] == '"'){						$t .= ('\\' . $r[$i]);					}else if($r[$i] == "\\"){						$t .= "\\" . $r[$i];					}else{						$t .= $r[$i];					}				}			return htmlspecialchars($t);		}		public function get_site_name(){			return 'Circle';		}	}?>