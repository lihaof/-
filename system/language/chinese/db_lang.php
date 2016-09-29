<?php
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP
 *
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2014 - 2015, British Columbia Institute of Technology
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package	CodeIgniter
 * @author	EllisLab Dev Team
 * @copyright	Copyright (c) 2008 - 2014, EllisLab, Inc. (http://ellislab.com/)
 * @copyright	Copyright (c) 2014 - 2015, British Columbia Institute of Technology (http://bcit.ca/)
 * @license	http://opensource.org/licenses/MIT	MIT License
 * @link	http://codeigniter.com
 * @since	Version 1.0.0
 * @filesource
 */
defined('BASEPATH') OR exit('No direct script access allowed');

$lang['db_invalid_connection_str'] = '设置有误，连接数据库服务器失败！';
$lang['db_unable_to_connect'] = '连接数据库服务器失败！';
$lang['db_unable_to_select'] = '选择数据库失败: %s';
$lang['db_unable_to_create'] = '创建数据库失败: %s';
$lang['db_invalid_query'] = '非法请求！';
$lang['db_must_set_table'] = '没有指定数据表！';
$lang['db_must_use_set'] = '必须使用SET方法来更新一条记录';
$lang['db_must_use_index'] = '必须指定索引来匹配批量更新操作';
$lang['db_batch_missing_index'] = '至少有一条所提交的记录缺失索引值';
$lang['db_must_use_where'] = '错误的升级语句';
$lang['db_del_must_use_where'] = '错误的删除语句';
$lang['db_field_param_missing'] = '获取域要求表名为一个参数';
$lang['db_unsupported_function'] = '不支持的方法';
$lang['db_transaction_failure'] = '清空失败';
$lang['db_unable_to_drop'] = '无法卸载数据库';
$lang['db_unsupported_feature'] = '所用数据库平台不支持所采用的特性';
$lang['db_unsupported_compression'] = '服务器不支持所指定的文件压缩格式';
$lang['db_filepath_error'] = '无法将文件写入指定路径';
$lang['db_invalid_cache_path'] = '缓存路径非法或者不可写';
$lang['db_table_name_required'] = '操作需要一个表名';
$lang['db_column_name_required'] = '操作需要一个有效的列名';
$lang['db_column_definition_required'] = '操作需要一个明确的列名';
$lang['db_unable_to_set_charset'] = '无法设置客户端连接字符集: %s';
$lang['db_error_heading'] = '数据库出了点小问题';
