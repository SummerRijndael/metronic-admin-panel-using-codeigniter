<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
function pdf_create($html, $filename, $stream) 
{ 

  /* require_once("dompdf/dompdf_config.inc.php");
    spl_autoload_register('DOMPDF_autoload');
    //$dompdf = new DOMPDF();
    //$dompdf->set_paper("a4", "portrait"); 
    //$dompdf->load_html($html);

    $html = 'asdfhgfh &#x39E;';
    //$html = utf8_encode($html);
    $dompdf = new DOMPDF(); $html = iconv('UTF-8','Windows-1250',$html);
    $dompdf->load_html($html);

    $dompdf->render();
    $pdf = $dompdf->output();
    if ($stream) {
        $dompdf->stream($filename.".pdf");
    }else {
        ini_set('error_reporting', E_ALL);
        if(!write_file("./files/temp/".$filename.".pdf", $pdf)) {
            echo "files/temp/".$filename.".pdf". ' -> PDF could not be saved! Check your server settings!';
           die();
            }
    }
    */




if (!function_exists('dompdf_usage'))
{
function dompdf_usage() {
  $default_paper_size = DOMPDF_DEFAULT_PAPER_SIZE;
  
  echo <<<EOD
  
Usage: {$_SERVER["argv"][0]} [options] html_file

html_file can be a filename, a url if fopen_wrappers are enabled, or the '-' character to read from standard input.

Options:
 -h             Show this message
 -l             List available paper sizes
 -p size        Paper size; something like 'letter', 'A4', 'legal', etc.  
                  The default is '$default_paper_size'
 -o orientation Either 'portrait' or 'landscape'.  Default is 'portrait'
 -b path        Set the 'document root' of the html_file.  
                  Relative urls (for stylesheets) are resolved using this directory.  
                  Default is the directory of html_file.
 -f file        The output filename.  Default is the input [html_file].pdf
 -v             Verbose: display html parsing warnings and file not found errors.
 -d             Very verbose: display oodles of debugging output: every frame 
                  in the tree printed to stdout.
 -t             Comma separated list of debugging types (page-break,reflow,split)
 
EOD;
exit;
}
}
/**
 * Parses command line options
 * 
 * @return array The command line options
 */

if (!function_exists('getoptions'))
{

function getoptions() {

  $opts = array();

  if ( $_SERVER["argc"] == 1 )
    return $opts;

  $i = 1;
  while ($i < $_SERVER["argc"]) {

    switch ($_SERVER["argv"][$i]) {

    case "--help":
    case "-h":
      $opts["h"] = true;
      $i++;
      break;

    case "-l":
      $opts["l"] = true;
      $i++;
      break;

    case "-p":
      if ( !isset($_SERVER["argv"][$i+1]) )
        die("-p switch requires a size parameter\n");
      $opts["p"] = $_SERVER["argv"][$i+1];
      $i += 2;
      break;

    case "-o":
      if ( !isset($_SERVER["argv"][$i+1]) )
        die("-o switch requires an orientation parameter\n");
      $opts["o"] = $_SERVER["argv"][$i+1];
      $i += 2;
      break;

    case "-b":
      if ( !isset($_SERVER["argv"][$i+1]) )
        die("-b switch requires a path parameter\n");
      $opts["b"] = $_SERVER["argv"][$i+1];
      $i += 2;
      break;

    case "-f":
      if ( !isset($_SERVER["argv"][$i+1]) )
        die("-f switch requires a filename parameter\n");
      $opts["f"] = $_SERVER["argv"][$i+1];
      $i += 2;
      break;

    case "-v":
      $opts["v"] = true;
      $i++;
      break;

    case "-d":
      $opts["d"] = true;
      $i++;
      break;

    case "-t":
      if ( !isset($_SERVER['argv'][$i + 1]) )
        die("-t switch requires a comma separated list of types\n");
      $opts["t"] = $_SERVER['argv'][$i+1];
      $i += 2;
      break;

   default:
      $opts["filename"] = $_SERVER["argv"][$i];
      $i++;
      break;
    }

  }
  return $opts;
}
}
require_once("dompdf/dompdf_config.inc.php");
global $_dompdf_show_warnings, $_dompdf_debug, $_DOMPDF_DEBUG_TYPES;

$sapi = php_sapi_name();
$options = array();

switch ( $sapi ) {

 case "cli":

  $opts = getoptions();

  if ( isset($opts["h"]) || (!isset($opts["filename"]) && !isset($opts["l"])) ) {
    dompdf_usage();
    exit;
  }

  if ( isset($opts["l"]) ) {
    echo "\nUnderstood paper sizes:\n";

    foreach (array_keys(CPDF_Adapter::$PAPER_SIZES) as $size)
      echo "  " . mb_strtoupper($size) . "\n";
    exit;
  }
  $file = $opts["filename"];

  if ( isset($opts["p"]) )
    $paper = $opts["p"];
  else
    $paper = DOMPDF_DEFAULT_PAPER_SIZE;

  if ( isset($opts["o"]) )
    $orientation = $opts["o"];
  else
    $orientation = "portrait";

  if ( isset($opts["b"]) )
    $base_path = $opts["b"];

  if ( isset($opts["f"]) )
    $outfile = $opts["f"];
  else {
    if ( $file === "-" )
      $outfile = "dompdf_out.pdf";
    else
      $outfile = str_ireplace(array(".html", ".htm", ".php"), "", $file) . ".pdf";
  }

  if ( isset($opts["v"]) )
    $_dompdf_show_warnings = true;

  if ( isset($opts["d"]) ) {
    $_dompdf_show_warnings = true;
    $_dompdf_debug = true;
  }

  if ( isset($opts['t']) ) {
    $arr = split(',',$opts['t']);
    $types = array();
    foreach ($arr as $type)
      $types[ trim($type) ] = 1;
    $_DOMPDF_DEBUG_TYPES = $types;
  }
  
  $save_file = true;

  break;

 default:

  if ( isset($_GET["input_file"]) )
    $file = rawurldecode($_GET["input_file"]);
  else
    //throw new DOMPDF_Exception("An input file is required (i.e. input_file _GET variable).");
  
  if ( isset($_GET["paper"]) )
    $paper = rawurldecode($_GET["paper"]);
  else
    $paper = DOMPDF_DEFAULT_PAPER_SIZE;
  
  if ( isset($_GET["orientation"]) )
    $orientation = rawurldecode($_GET["orientation"]);
  else
    $orientation = "portrait";
  
  if ( isset($_GET["base_path"]) ) {
    $base_path = rawurldecode($_GET["base_path"]);
    $file = $base_path . $file; # Set the input file
  }  
  
  if ( isset($_GET["options"]) ) {
    $options = $_GET["options"];
  }
  /*
  $file_parts = explode_url($file);
  
  /* Check to see if the input file is local and, if so, that the base path falls within that specified by DOMDPF_CHROOT 
  if(($file_parts['protocol'] == '' || $file_parts['protocol'] === 'file://')) {
    $file = realpath($file);
    if ( strpos($file, DOMPDF_CHROOT) !== 0 ) {
      throw new DOMPDF_Exception("Permission denied on $file. The file could not be found under the directory specified by DOMPDF_CHROOT.");
    }
  } */
  
  $outfile = $filename.".pdf"; # Don't allow them to set the output file
  $save_file = false; # Don't save the file
  
  break;
}

$dompdf = new DOMPDF();

/* Uncomment the line below in order to activate special characters (Chiniese, Korean,...)*/
/* $html = mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8'); */ 
$dompdf->load_html($html);


if ( isset($base_path) ) {
  $dompdf->set_base_path($base_path);
}

$dompdf->set_paper($paper, $orientation);

$dompdf->render();

if ( $_dompdf_show_warnings ) {
  global $_dompdf_warnings;
  foreach ($_dompdf_warnings as $msg)
    echo $msg . "\n";
  echo $dompdf->get_canvas()->get_cpdf()->messages;
  flush();
}

if ( $save_file ) {
//   if ( !is_writable($outfile) )
//     throw new DOMPDF_Exception("'$outfile' is not writable.");
  ini_set('error_reporting', E_ALL);
        if(!write_file("./files/temp/".$filename.".pdf", $pdf)) {
            echo "files/temp/".$filename.".pdf". ' -> PDF could not be saved! Check your server settings!';
           die();
            }
}

if ( !headers_sent() ) {


if ($stream) {
        $dompdf->stream($outfile, $options);
    }else {
        $pdf = $dompdf->output();
        ini_set('error_reporting', E_ALL);
        if(!write_file("./files/temp/".$filename.".pdf", $pdf)) {
            echo "files/temp/".$filename.".pdf". ' -> PDF could not be saved! Check your server settings!';
           die();
            }
    }


}

}