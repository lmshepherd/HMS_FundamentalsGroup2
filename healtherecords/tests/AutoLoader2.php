<?php
class AutoLoade2r{
	static private $classNames = array();
	
	public static function registerDirectory($dirName){
		
		$di=new DirectoryIterator($dirName);
		foreach($di as $file){
			if($file->isDir() && !$file->isLink() && !$file->isDot()){
				//recurse into directories
				self::registerDirectory($file->getPathname());
			}
			elseif(substr($file->getFilename(), -4) === '.php'){
				//save the class name / path of a .php file found
				$className= substr($file->getFilename(),0,-4);
				AutoLoader::registerClass($className, $file->getPathname());
			}
		}
	}//end registerDirectory
	
	public static function registerClass($className, $fileName){
		AutoLoader::$classNames[$className]=$fileName;
	}//end registerClass
	
	public static function loadClass($className){
		if(isset(AutoLoader::$classNames[$className])){
			require_once(AutoLoader::$classNames[$className]);
		}	
	}//end loadclass
}

spl_autoload_register(array('AutoLoader', 'loadClass'));
?>