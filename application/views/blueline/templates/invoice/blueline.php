<?php

$language = $this->input->cookie('language');
if (!isset($language))
{
  $language = $core_settings->language;
}
if(isset($htmlPreview)){
  $htmlPreview = 'style="padding:40px; width:750px"';
}else{
  $htmlPreview = "";
}
if($invoice->due_date <= date('Y-m-d') && $invoice->status != "Paid"){ 
  $status = "Overdue"; }else{
   $status = $invoice->status;
  }
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xml:lang="en" lang="en">
<head>
  <meta name="Author" content="<?= $core_settings->company?>"/> 
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <style type="text/css">

    @font-face {
    font-family: customfont;
    src: url(<?php if( $core_settings->pdf_path == 1 ) {echo base_url(); } ?>assets/blueline/fonts/<?= $core_settings->pdf_font?>-Regular.ttf);
    font-weight: 400;
    }
    @font-face {
    font-family: customfont;
    src: url(<?php if( $core_settings->pdf_path == 1 ) {echo base_url(); } ?>assets/blueline/fonts/<?= $core_settings->pdf_font?>-Bold.ttf);
    font-weight: 600;
    }
body{
  color: #61686d;
  font: 12px "customfont", Helvetica, Arial, Verdana, sans-serif;
  font-weight: 400;
  padding-bottom: 60px;
}
p{
  margin:0px;
  padding:0px;
}
.center{
  text-align: center !important;
}
.right{
  text-align: right !important;
}
.left{
  text-align: left !important;
}
.top-background{
  color:#000000;
  border-bottom:2px solid #11A7DB;
  width:100%; 
  margin:-44px -44px 0px;
  padding:40px 40px 5px;
}

.status {
  font-weight: 400;
  text-transform: uppercase;
  color: #FFF;
  font-size: 16px;
  margin-top: -5px;
  text-align: right;

}

.Open {color: #FC704C; }
.Sent {color: #EAAA10; }
.Paid {color: #43AC6E; }
.Overdue {color: #FC704C; }

.company-logo {
  margin-bottom: 10px;
}

.company-address {
  line-height:11px;
}
.recipient-address {
  line-height:13px;
}
.invoicereference{
  font-size: 22px;
  font-weight: 400;
  margin:10px 0;
}

#table{
  width:100%;
  margin:20px 0px;
}

#table tr.header th{
  font-weight: 600;
  color:#777777;
  font-size: 10px;
  text-transform: uppercase;
  border-bottom:2px solid #DDDDDD;
  padding:0 5px 10px;
}
#table tr td{
  font-weight: lighter;
  color:#444444;
  font-size: 12px;
  border-bottom:1px solid #DDDDDD;
  padding:15px 5px;

}
#table tr td .item-name{
  font-weight: 600;
  color:#444444;
}
#table tr td .description{
  font-weight: 400;
  color:#888888;
  font-size: 10px;
}

.padding{
  padding: 5px 0px;
}
.total-amount {
  padding: 8px 20px 8px 0;
  color: #FFFFFF;
  font-size: 17px;
  font-weight: 400;
  margin: 0;
  text-align: right;
}

.custom-terms {
  padding:20px 2px;
  border-bottom:1px solid #DDDDDD;
  font-size: 12px;
}
.over{
  text-transform: uppercase;
  font-size: 10px;
  font-weight: 600;

}
.under{
  font-size: 16px;
}

.total-heading {
  background: #11A7DB;
  color: #FFFFFF;
  text-align: right;
  padding:10px;

}
.side{
  padding:10px;
  background: #EDF2F4;
}

.footer{
  padding:5px 1px;
  font-size: 9px;
  text-align:center;
}

.footer .page:after { content: counter(page, upper-roman); }
.footer .pagecount:after { content: counter(count, upper-roman); }


    </style>

</head>

<body <?php echo $htmlPreview; ?>>

<div class="top-background">
   <table width="100%" cellspacing="0" >
         <tr>
           <td><img src="<?php if( $core_settings->pdf_path == 1 ) {echo base_url(); } ?><?=$core_settings->invoice_logo;?>" class="company-logo" /></td>
           <td style="vertical-align: top;"><div class="status <?php echo $status;?>"> <?=$this->lang->line('application_'.$status);?></div></td>
         </tr>
         <tr>
            <td style="vertical-align:top"><?=$core_settings->company;?></td>
            <td class="right" style="vertical-align:top"><?=$invoice->company->name;?></td>
        </tr> 
        <tr>
            <td style="vertical-align:top"><?=$core_settings->invoice_contact;?></td>
            <td class="right" style="vertical-align:top"><strong><?php if(isset($invoice->company->client->firstname)){ ?> <?=$invoice->company->client->firstname;?> <?=$invoice->company->client->lastname;?></strong><?php } ?></td>
        </tr>
        <tr>
            <td style="vertical-align:top"><?=$core_settings->invoice_address;?></td>
            <td class="right" style="vertical-align:top"><?=$invoice->company->address;?></td>
        </tr>
        <tr>
            <td style="vertical-align:top"><?=$core_settings->invoice_city;?></td>
            <td class="right" style="vertical-align:top"><?=$invoice->company->city;?>, <?=$invoice->company->zipcode;?></td>
        </tr>
        <tr>
            <td style="vertical-align:top"></td>
            <td class="right" style="vertical-align:top"><?php if($invoice->company->province != ""){?><?=$invoice->company->province;?><?php } ?></td>
        </tr>
        <tr>
            <td style="vertical-align:top"></td>
            <td class="right" style="vertical-align:top"><?php if($invoice->company->vat != ""){?><?=$this->lang->line('application_vat');?>: <?php echo $invoice->company->vat; ?><?php } ?></td>
        </tr>
        <tr>
          <td class="padding" style="vertical-align:top">
          <span class="invoicereference"><?=$this->lang->line('application_invoice');?> <?=$core_settings->invoice_prefix;?><?=$invoice->reference;?></span><br/>
          <span class="over"><?php $unix = human_to_unix($invoice->issue_date.' 00:00'); echo date($core_settings->date_format, $unix);?></span>
          </td>
          <td class="padding" align="right" style="vertical-align:bottom">
          <?=$this->lang->line('application_due_date');?> <?php echo date($core_settings->date_format, human_to_unix($invoice->due_date.' 00:00:00'));?>
          </td>
        </tr>
  </table>
 
</div>
<div class="content">
  <table id="table" cellspacing="0"> 
  <thead> 
  <tr class="header"> 
    <th class="left"><?=$this->lang->line('application_item');?></th>
    <th width="9%" class="center"><?=$this->lang->line('application_hrs_qty');?></th>
    <th width="15%" class="right"><?=$this->lang->line('application_unit_price');?></th>
    <th width="15%" class="right"><?=$this->lang->line('application_sub_total');?></th>
  </tr> 
  </thead> 
  <tbody> 
  <?php $i = 0; $sum = 0; $row=false; ?>
    <?php foreach ($items as $value):?>
    <tr <?php if($row){?>class="even"<?php } ?>>
      <td>
        <span class="item-name"><?php if(!empty($value->name)){echo $value->name;}else{ echo $invoice->invoice_has_items[$i]->item->name; }?></span><br/>
        <span class="description"><?= str_replace("&lt;br&gt;", "<br>", $invoice->invoice_has_items[$i]->description);?><span class="item-name">
      </td>
      <td class="center"><?=$invoice->invoice_has_items[$i]->amount;?></td>
      <td class="right"><?php echo display_money(sprintf("%01.2f",$invoice->invoice_has_items[$i]->value));?></td>
      <td class="right"><?php echo display_money(sprintf("%01.2f",$invoice->invoice_has_items[$i]->amount*$invoice->invoice_has_items[$i]->value));?></td>
    </tr>
    <?php $sum = $sum+$invoice->invoice_has_items[$i]->amount*$invoice->invoice_has_items[$i]->value; $i++; if($row){$row=false;}else{$row=true;}?>
    
    <?php endforeach;
    if(empty($items)){ echo "<tr><td colspan='4'>".$this->lang->line('application_no_items_yet')."</td></tr>";}
    if(substr($invoice->discount, -1) == "%"){ $discount = sprintf("%01.2f", round(($sum/100)*substr($invoice->discount, 0, -1), 2)); }
    else{$discount = $invoice->discount;}
    $sum = $sum-$discount;
    $presum = $sum;

    if($invoice->tax != ""){
      $tax_value = $invoice->tax;
    }else{
      $tax_value = $core_settings->tax;
    }

     if($invoice->second_tax != ""){
      $second_tax_value = $invoice->second_tax;
    }else{
      $second_tax_value = $core_settings->second_tax;
    }

    $tax = sprintf("%01.2f", round(($sum/100)*$tax_value, 2));
    $second_tax = sprintf("%01.2f", round(($sum/100)*$second_tax_value, 2));

    $sum = sprintf("%01.2f", round($sum+$tax+$second_tax, 2));
    ?>
    
  </tbody> 
  </table> 
</div>
<div>

        <table width="100%">
          
        <tr>
          <?php if ($invoice->discount != 0): ?><td class="side"><span class="over"><?=$this->lang->line('application_discount');?></span><br/><span class="under">- <?=display_money($discount, $invoice->currency);?></span></td><?php endif ?>
          <td class="side"><span class="over"><?=$this->lang->line('application_sub_total');?></span><br/><span class="under"><?=display_money($presum, $invoice->currency);?></span></td>
          <?php if($tax_value != "0"){ ?><td class="side"><span class="over"><?=$this->lang->line('application_tax');?> (<?= $tax_value?>%)</span><br/><span class="under"><?=display_money($tax, $invoice->currency)?></span></td><?php } ?>
          <?php if($second_tax_value != "0" && $second_tax_value != ""){ ?><td class="side"><span class="over"><?=$this->lang->line('application_second_tax');?> (<?= $second_tax_value?>%)</span><br/><span class="under"><?=display_money($second_tax, $invoice->currency)?></span></td><?php } ?>
          <?php if($invoice->paid > "0"){ ?><td class="side"><span class="over"><?=$this->lang->line('application_payments_received');?></span><br/><span class="under"><?=display_money($invoice->paid, $invoice->currency)?></span></td><?php } ?>
         
          <td class="total-heading"><span class="over"><?php if($invoice->paid > "0"){ echo $this->lang->line('application_total_outstanding'); } else{ echo $this->lang->line('application_total'); }?></span><br/><span class="under"><?=display_money($sum-$invoice->paid, $invoice->currency);?></span></td>
        </tr> 

        </table>



    <div class="custom-terms"><?php echo $invoice->terms; ?></div>
    <div class="footer"><b><?=$core_settings->company;?></b> | <?=$core_settings->email;?><?php if($core_settings->invoice_tel != ""){echo " | ".$core_settings->invoice_tel;};?><?php if($core_settings->vat != ""){echo " | ".$this->lang->line('application_vat').": ".$core_settings->vat;}?></div>
  <script type='text/php'>
        if ( isset($pdf) ) { 
          $font = Font_Metrics::get_font('helvetica', 'normal');
          $size = 9;
          $y = $pdf->get_height() - 24;
          $x = $pdf->get_width() - 15 - Font_Metrics::get_text_width('1/1', $font, $size);
          $pdf->page_text($x, $y, '{PAGE_NUM}/{PAGE_COUNT}', $font, $size);
        } 
      </script>

</div>

</body>
</html>
