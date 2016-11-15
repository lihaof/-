<?php !defined("FCPATH") && exit("Access Denied!"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=0.5, maximum-scale=2.0, user-scalable=yes">
    <script type="text/javascript" src="{:base_url('js/jquery.js')}"></script>
    <link rel="stylesheet" type="text/css" href="{:base_url('css/option.css')}">

    <title>设置页面</title>
</head>
<body>

    <div class="main-box">
        <div class="main-box-title">基本设置</div>
<!--{:form_open('Option/save_option')}-->
<!--{foreach $option $row}-->
<!--{if $row["otype"]==0}-->
        <div class="box2">
            <div class="box-title">{:$row["oname"]}</div>
            <input type="text" class="box-input" name={:$nameNum} value={:$row["ovalue"][0]}>
            <div class="box-hint">{:$row["odescription"]}</div>
        </div>
<!--{elseif $row["otype"]==1}-->
        <div class="box">
            <div class="box-title box-title-radio">{:$row["oname"]}</div>
            <!--{foreach $row["oselection"] $selection}-->
            <!--{if $row["ovalue"][0] == $number}-->
                <div class="box-div">
                    <input class="box-radio" type="radio" checked="checked" name={:$nameNum} value={:$number++}>
                    <span class="box-radio-text">{:$selection}</span>
                </div>
            <!--{elseif $row["ovalue"][0] != $number}-->
                <div class="box-div">
                    <input class="box-radio" type="radio" name={:$nameNum} value={:$number++}>
                    <span class="box-radio-text">{:$selection}</span>
                </div>
            <!--{/if}-->
            <!--{/foreach}--> 
                <div class="box-hint">{:$row["odescription"]}</div>
        </div>
<!--{elseif $row["otype"]==2}-->
        <div class="box">
            <div class="box-title box-title-check">{:$row["oname"]}</div>
            <!--{foreach $row["oselection"] $selection}-->
            <!--{if in_array($number, $row['ovalue'])}-->
            <div class="box-div">
                <input class="box-checkbox" type="checkbox" name={:$nameNum}[] value={:$number++} checked="checked">
                <span class="box-checkbox-text">{:$selection}</span>
            </div>
            <!--{else}-->
            <div class="box-div">
                <input class="box-checkbox" type="checkbox" name={:$nameNum}[] value={:$number++}>
                <span class="box-checkbox-text">{:$selection}</span>
            </div>
            <!--{/if}-->
            <!--{/foreach}-->
            <div class="box-hint">{:$row["odescription"]}</div>
        </div>
<!--{elseif $row["otype"]==3}-->
        <div class="box">
            <div class="box-title">{:$row["oname"]}</div>
            <select class="box-select" name={:$nameNum}>
            <!--{foreach $row["oselection"] $selection}-->
            <!--{if $row["ovalue"][0] == $number}-->
                <option value={:$number++} selected="selected">{:$selection}</option>
            <!--{elseif $row["ovalue"][0] != $number}-->
                <option value={:$number++}>{:$selection}</option>
            <!--{/if}-->
            <!--{/foreach}-->
            </select>
            <div class="box-hint">{:$row["odescription"]}</div>
        </div>
<!--{/if}-->
<?php $number = 0 ?>
<?php $nameNum++ ?>
<!--{/foreach}-->
        <!--确认提交-->
        <div class="box-btn"><button class="btn-check" type="submit">保存设置</button></div>
    </div>
</body>
</html>