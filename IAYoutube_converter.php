<?php require_once('Connections/redes.php'); ?>
<?php require_once('Connections/redes.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO YTLink (YTLink, ID) VALUES (%s, %s)",
                       GetSQLValueString($_POST['YTLink'], "text"),
                       GetSQLValueString($_POST['ID'], "int"));

  mysql_select_db($database_redes, $redes);
  $Result1 = mysql_query($insertSQL, $redes) or die(mysql_error());

  $insertGoTo = "IAYoutube_converter.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

mysql_select_db($database_redes, $redes);
$query_Linker = "SELECT * FROM YTLink";
$Linker = mysql_query($query_Linker, $redes) or die(mysql_error());
$row_Linker = mysql_fetch_assoc($Linker);
$totalRows_Linker = mysql_num_rows($Linker);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Random Number</title>
<style type="text/css">
body {
	background-color: #000;
}
.CodeConv {
	color: #FFF;
}
</style>
</head>

<body>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table align="center">
    <tr valign="baseline">
      <td align="right" nowrap="nowrap" bgcolor="#FFCC00">Link de Youtube::</td>
      <td><input type="text" name="YTLink" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="submit" value="Convertir" /></td>
    </tr>
  </table>
  <input type="hidden" name="ID" value="" />
  <input type="hidden" name="MM_insert" value="form1" />
</form>
<table width="200" border="0" align="center" cellpadding="2" cellspacing="2">
  <tr>
    <td bgcolor="#FFCC00">Link</td>
    <td bgcolor="#FFCC00">Código</td>
  </tr>
  <tr>
    <td class="CodeConv"><img name="" src="https://i.ytimg.com/vi/<?php echo $row_Linker['YTLink']; ?>/hqdefault.jpg" width="150" height="150" alt="" /></td>
    <td class="CodeConv">&lt;figure&gt;&lt;iframe width=&quot;560&quot; height=&quot;315&quot; src=&quot;https://www.youtube.com/embed/<?php echo $row_Linker['YTLink']; ?>&quot; frameborder=&quot;0&quot; allowfullscreen&gt;&lt;/iframe&gt;&lt;/figure&gt;&lt;figure class=&quot;op-ad&quot;&gt;&lt;iframe width=&quot;300&quot; height=&quot;250&quot; style=&quot;border:0; margin:0;&quot; src=&quot;https://www.facebook.com/adnw_request?placement=228597314276736_231231354013332&amp;amp;adtype=banner300x250&quot;&gt;&lt;/iframe&gt;</td>
  </tr>
</table>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($Linker);
?>
