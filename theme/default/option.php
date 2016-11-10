<?php !defined("FCPATH") && exit("Access Denied!"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <script type="text/javascript" src="{:base_url('js/jquery.js')}"></script>
    <title>设置页面</title>
</head>
<style>
    *{
        padding: 0;
        margin: 0;
        font-family: "Helvetica Neue", Helvetica, STHeiTi, sans-serif;
    }

    body{
        padding: 30px 0;
        background-color: #f6f6f3;
    }

    .main-box{
        width: 100%;
        height: auto;
        text-align: center;
    }

    .main-box-title{
        font-size: 25px;
    }

    .box{
        width: 700px;
        height: 100px;
        margin: 0 auto;
        margin-bottom: 10px;
    }

    .box-title{
        font-size: 16px;
        color: #656565;
        float: left;
    }

    .box-input{
        width: 700px;
        height: 30px;
        float: left;
        margin-top: 10px;
        border-radius: 3px;
        border: 0;
        box-shadow: 1px 1px 1px #c4c4c4;
        box-sizing: border-box;
    }

    .box-hint{
        float: left;
        font-size: 14px;
        margin-top: 10px;
        color: #b6b6b6;
    }

    .box-radio-form{
        margin-top: 20px;
    }

    .box-radio{
        float: left;
        color: #5d5d5d;
    }

    .box-radio-text{
        float: left;
        margin-left: 10px;
        color: #363636;
        margin-right: 20px;
    }

    .box-checkbox-form{
        margin-top: 20px;
    }

    .box-checkbox{
        float: left;
        margin-top: 3px;

    }

    .box-checkbox-text{
        float: left;
        margin-left: 10px;
        color: #363636;
        margin-right: 10px;
    }

    .btn-check{
        width: 120px;
        height: 36px;
        border: 1px solid #f0f0f0;
        background-color: #fff;
        border-radius: 3px;
    }



</style>
<body>

    <div class="main-box">
        <h class="main-box-title">基本设置</h>
<!--{:form_open('Option/save_option')}-->
<!--{foreach $option $row}-->
<!--{if $row["otype"]==0}-->
        <div class="box">
            <p class="box-title">{:$row["oname"]}</p><br>
                <input type="text" class="box-input" name={:$nameNum} value={:$row["ovalue"][0]}>
                <p class="box-hint">{:$row["odescription"]}</p>
        </div><br>
<!--{elseif $row["otype"]==1}-->
        <div class="box">
            <p class="box-title">{:$row["oname"]}</p><br>
            <!--{foreach $row["oselection"] $selection}-->
            <!--{if $row["ovalue"][0] == $number}-->
                <input class="box-radio" type="radio" checked="checked" name={:$nameNum} value={:$number++}><span class="box-radio-text">{:$selection}</span>
            <!--{elseif $row["ovalue"][0] != $number}-->
                <input class="box-radio" type="radio" name={:$nameNum} value={:$number++}><span class="box-radio-text">{:$selection}</span>
            <!--{/if}-->
            <!--{/foreach}--> 
                <br><p class="box-hint">{:$row["odescription"]}</p>
        </div><br><br>
<!--{elseif $row["otype"]==2}-->
        <div class="box">
            <p class="box-title">{:$row["oname"]}</p><br>
            <!--{foreach $row["oselection"] $selection}-->
            <!--{if in_array($number, $row['ovalue'])}-->
                <input class="box-checkbox" type="checkbox" name={:$nameNum}[] value={:$number++} checked="checked"><span class="box-checkbox-text">{:$selection}</span><br>
            <!--{else}-->
                <input class="box-checkbox" type="checkbox" name={:$nameNum}[] value={:$number++}><span class="box-checkbox-text">{:$selection}</span><br>
            <!--{/if}-->
            <!--{/foreach}-->
            <p class="box-hint">{:$row["odescription"]}</p>
        </div><br><br>
<!--{elseif $row["otype"]==3}-->
        <div class="box">
            <p class="box-title">{:$row["oname"]}</p><br>
                <select class="box-select" name={:$nameNum}>
                <!--{foreach $row["oselection"] $selection}-->
                <!--{if $row["ovalue"][0] == $number}-->
                    <option value={:$number++} selected="selected">{:$selection}</option>
                <!--{elseif $row["ovalue"][0] != $number}-->
                    <option value={:$number++}>{:$selection}</option>
                <!--{/if}-->
                <!--{/foreach}-->
                </select><br>
                <p class="box-hint">{:$row["odescription"]}</p>
        </div><br><br>
<!--{/if}-->
<?php $number = 0 ?>
<?php $nameNum++ ?>
<!--{/foreach}-->
        <!--确认提交-->
        <button class="btn-check" type="submit">保存设置</button>
    </div>
</body>
</html>