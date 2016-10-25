<?php

/**
 *	简易模板引擎V1.0
 *	@Author: RuphiLau
 *
 *	使用说明：
 *		Ui.php是一个简易的模板引擎，它作用于MVC模式中的View层，是在View的基础上
 *	搭设的一层解析器，目的是为了解决Codeigniter中用原生PHP写模板的繁琐和Parser库
 *	的效率低问题。
 *		Ui.php是一个解析器，它会将自定义的模板语句编译为PHP可识别的语句，并自动写入
 *	application/views文件夹，采用Ui.php后，无需再使用$this->load->view了，因为
 *	$this->load->view会被自动调用
 *
 *	使用Ui.php很简单，只需三个步骤：
 *	1、采用Ui.php自定义的模板语句语法编写模板文件
 *	2、模板文件放入theme/default文件夹里
 *	3、原来应该用$this->load->view的地方，改为用$this->ui->load，其他地方不变
 *
 *	Ui.php模板语句语法：
 *	1、采用{xxx}{/xxx}形式定界，如{if}{/if}
 *	2、可以在 { 前面加入 <!-- 或者 /*，在 } 后面加入 !--> 或者 ※/（※用*替换）修饰
 *	3、原来的 <?php echo $param; ?>改用 {:$param}，即{:要echo的表达式或者变量}
 *	4、原来的 <?php foreach($arr as $key => $val): ?>
 *	   改为 {foreach $arr $key $val}，<?php endforeach; ?> 改为 {/foreach}
 *	5、原来的 <?php if($xxx): ?> 改为 {if $xxx}，<?php endif; ?> 改为 {/if}
 *	6、原来的 <?php …… ?> 改为 {execute}……{/execute}
 */

class Ui {
	private $CI;
	private $themeName;

	public function __construct() {
		$this->CI =& get_instance();

		$this->themeName = "default";
	}

	/**
	 *	转换视图目录的路径
	 *	@param $pathName 路径名称
	 */
	private function viewPath($pathName) {
		return FCPATH . "application/views/".$pathName.".php";
	}

	/**
	 *	转换模板目录的路径
	 *	@param $pathName 路径名称
	 */
	private function themePath($pathName) {
		return FCPATH . "theme/".$this->themeName."/".$pathName.".php";
	}

	/**
	 *	模板解析器
	 *
	 */
	private function parser(&$template) {
		$template = preg_replace("/<!\-\-{/", "{", $template);
		$template = preg_replace("/}\-\->/", "}", $template);
		$template = preg_replace("/\/\*{/", "{", $template);
		$template = preg_replace("/}\*\//", "}", $template);

		// 解析变量
		$template = preg_replace("/{var\:(.+?)}/i", "<?php echo $1; ?>", $template);

		// 解析条件语句
		$template = preg_replace("/{if\s([^}]+)}/i", "<?php if($1): ?>", $template);
		$template = preg_replace("/{elseif\s([^}]+)}/i", "<?php elseif($1): ?>", $template);
		$template = preg_replace("/{else}/i", "<?php else: ?>", $template);
		$template = preg_replace("/{\/if}/i", "<?php endif; ?>", $template);

		// 解析循环语句
		$template = preg_replace("/{while\s([^}]+)}/i", "<?php while($1): ?>", $template);
		$template = preg_replace("/{\/endwhile}/i", "<?php endwhile; ?>", $template);

		// 解析FOR语句
		$template = preg_replace("/{for\s([^}]+)}/i", "<?php for($1): ?>", $template);
		$template = preg_replace("/{\/for}/i", "<?php endfor; ?>", $template);

		// 解析遍历语句
		$template = preg_replace("/{foreach\s([^}]+)\s([^}]+)\s([^}]+)}/i", "<?php foreach($1 as $2 => $3): ?>", $template);	
		$template = preg_replace("/{foreach\s([^}]+)\s([^}]+)}/i", "<?php foreach($1 as $2): ?>", $template);	
		$template = preg_replace("/{\/foreach}/i", "<?php endforeach; ?>", $template);

		// 解析PHP语句
		$template = preg_replace("/{execute}/", "<?php".PHP_EOL, $template);
		$template = preg_replace("/{\/execute}/", PHP_EOL."?>", $template);

		// 解析输出语句
		$template = preg_replace("/{\:(.+?)}/", "<?php echo $1; ?>", $template);
		$template = preg_replace("/{(.+?)\?\:(.+?)}/", "<?php echo $1 ? $1 : $2; ?>", $template);

		return $template;
	}

	public function load($fileName, &$params = array(), $asReturn = false) {
		$themeFilePath = $this->themePath($fileName);
		$viewFilePath  = $this->viewPath($fileName);

		if(!file_exists($themeFilePath)) {
			printf("FILE %s IS MISSING", $fileName);
		} else {
			$updated = false;
			if(!file_exists($viewFilePath)) $updated = true;
			else if(filemtime($themeFilePath) >= filemtime($viewFilePath)) $updated = true;

			if($updated) {
				$template = file_get_contents($themeFilePath);
				$template = $this->parser($template);

				$dirs = explode("/", $fileName);
				unset($dirs[count($dirs)-1]);
				foreach($dirs as $eachDir) {
					$path = FCPATH."application/views/".$eachDir;
					if(!file_exists($path)) {
						file_put_contents($path."/index.htm", "");
						mkdir($path, 0777);
					}
				}

				file_put_contents($viewFilePath, $template);
			}

			if($asReturn) {
				return $this->CI->load->view($fileName, $params, true);
			}

			$this->CI->load->view($fileName, $params);
		}
	}
}