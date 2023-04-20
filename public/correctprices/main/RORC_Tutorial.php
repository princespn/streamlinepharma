<?php include "check_user.php"; ?>
<?php include "include/db.php"; ?>
<!DOCTYPE html>
<html lang="en"
xmlns:v="urn:schemas-microsoft-com:vml"
xmlns:o="urn:schemas-microsoft-com:office:office"
xmlns:w="urn:schemas-microsoft-com:office:word"
xmlns:m="http://schemas.microsoft.com/office/2004/12/omml"
xmlns="http://www.w3.org/TR/REC-html40">

<head>
    <?php include "include/header-script.php"; ?>
	<link rel="icon" type="image/png" href="favicon.png">
	<link href='https://fonts.googleapis.com/css?family=Courier Prime' rel='stylesheet'>
	<title>Tutorial</title>
	<style>
		.container-fluid {
			font-family: 'Courier Prime';
		}
		.center {
			position: absolute;
			left: 50%;
		}
		button {
    appearance: auto;
    -webkit-writing-mode: horizontal-tb !important;
    text-rendering: auto;
    color: -internal-light-dark(black, white);
    letter-spacing: normal;
    word-spacing: normal;
    text-transform: none;
    text-indent: 0px;
    text-shadow: none;
    display: inline-block;
    text-align: center;
    align-items: flex-start;
    cursor: default;
    background-color: -internal-light-dark(rgb(239, 239, 239), rgb(59, 59, 59));
    box-sizing: border-box;
    margin: 0em;
    font: 400 13.3333px Arial;
    padding: 1px 6px;
    border-width: 2px;
    border-style: outset;
    border-color: -internal-light-dark(rgb(118, 118, 118), rgb(133, 133, 133));
    border-image: initial;
}
	</style>
</head>

<body class="animsition">
    <div class="page-wrapper">
        <?php //include "include/left-menu.php"; ?>

        <!-- PAGE CONTAINER-->
        <div class="page-container">
            <?php include "include/header.php"; ?>

            <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">

<h2><b><u><span style='font-size:14.0pt;line-height:107%'>Saving
the Required Pricing Data from RORC<o:p></o:p></span></u></b></h2>

<p class=MsoNormal><b style='mso-bidi-font-weight:normal'>Store Pricing Data:<o:p></o:p></b></p>

<p class=MsoListParagraphCxSpFirst style='margin-bottom:10.0pt;mso-add-space:
auto;text-indent:.25in;line-height:115%;mso-list:l2 level1 lfo2'><![if !supportLists]><span
style='mso-bidi-font-family:Calibri;mso-bidi-theme-font:minor-latin'><span
style='mso-list:Ignore'>1.<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]>Open <span class=SpellE>RORC</span></p>

<p class=MsoListParagraphCxSpMiddle style='margin-bottom:10.0pt;mso-add-space:
auto;text-indent:.25in;line-height:115%;mso-list:l2 level1 lfo2'><![if !supportLists]><span
style='mso-bidi-font-family:Calibri;mso-bidi-theme-font:minor-latin'><span
style='mso-list:Ignore'>2.<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]>Enter login info, Sign In</p>

<p class=MsoListParagraphCxSpMiddle style='margin-bottom:10.0pt;mso-add-space:
auto;text-indent:.25in;line-height:115%;mso-list:l2 level1 lfo2'><![if !supportLists]><span
style='mso-bidi-font-family:Calibri;mso-bidi-theme-font:minor-latin'><span
style='mso-list:Ignore'>3.<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]>Open RORC Enhanced Reporting (contact your software provider if you don't have an icon on the desktop)</p>

<p class=MsoListParagraphCxSpMiddle style='margin-bottom:10.0pt;mso-add-space:
auto;text-indent:.25in;line-height:115%;mso-list:l2 level1 lfo2'><![if !supportLists]><span
style='mso-bidi-font-family:Calibri;mso-bidi-theme-font:minor-latin'><span
style='mso-list:Ignore'>4.<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]>Select Item Reports</p>

<p class=MsoListParagraphCxSpMiddle style='margin-bottom:10.0pt;mso-add-space:
auto;text-indent:.25in;line-height:115%;mso-list:l2 level1 lfo2'><![if !supportLists]><span
style='mso-bidi-font-family:Calibri;mso-bidi-theme-font:minor-latin'><span
style='mso-list:Ignore'>5.<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]>Select Item Price List</p>

<p class=MsoListParagraphCxSpMiddle style='margin-bottom:10.0pt;mso-add-space:
auto;text-indent:.25in;line-height:115%;mso-list:l2 level1 lfo2'><![if !supportLists]><span
style='mso-bidi-font-family:Calibri;mso-bidi-theme-font:minor-latin'><span
style='mso-list:Ignore'>6.<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]>Uncheck box "Show Base Price instead of Current Lane Price</p>

<p class=MsoListParagraphCxSpMiddle style='margin-bottom:10.0pt;mso-add-space:
auto;text-indent:.25in;line-height:115%;mso-list:l2 level1 lfo2'><![if !supportLists]><span
style='mso-bidi-font-family:Calibri;mso-bidi-theme-font:minor-latin'><span
style='mso-list:Ignore'>7.<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]>Select Submit</p>

<p class=MsoListParagraphCxSpMiddle style='margin-bottom:10.0pt;mso-add-space:
auto;text-indent:.25in;line-height:115%;mso-list:l2 level1 lfo2'><![if !supportLists]><span
style='mso-bidi-font-family:Calibri;mso-bidi-theme-font:minor-latin'><span
style='mso-list:Ignore'>8.<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]>Above the data on the right, Check box that says "Show Columns"</p>

<p class=MsoListParagraphCxSpMiddle style='margin-bottom:10.0pt;mso-add-space:
auto;text-indent:.25in;line-height:115%;mso-list:l2 level1 lfo2'><![if !supportLists]><span
style='mso-bidi-font-family:Calibri;mso-bidi-theme-font:minor-latin'><span
style='mso-list:Ignore'>9.<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]>Check the box for Dept. Code</p>

<p class=MsoListParagraphCxSpMiddle style='margin-bottom:10.0pt;mso-add-space:
auto;text-indent:.25in;line-height:115%;mso-list:l2 level1 lfo2'><![if !supportLists]><span
style='mso-bidi-font-family:Calibri;mso-bidi-theme-font:minor-latin'><span
style='mso-list:Ignore'>10.<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;
</span></span></span><![endif]>Select Export to CSV</p>
						
<p class=MsoListParagraphCxSpMiddle style='margin-bottom:10.0pt;mso-add-space:
auto;text-indent:.25in;line-height:115%;mso-list:l2 level1 lfo2'><![if !supportLists]><span
style='mso-bidi-font-family:Calibri;mso-bidi-theme-font:minor-latin'><span
style='mso-list:Ignore'>11.<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;
</span></span></span><![endif]>Choose location to save the file and name file appropriately so you know <span
class=GramE>it’s</span> the store pricing data</p>

<p class=MsoListParagraphCxSpMiddle style='margin-bottom:10.0pt;mso-add-space:
auto;text-indent:.25in;line-height:115%;mso-list:l2 level1 lfo2'><![if !supportLists]><span
style='mso-bidi-font-family:Calibri;mso-bidi-theme-font:minor-latin'><span
style='mso-list:Ignore'>12.<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;
</span></span></span><![endif]>Click Save</p>

<p class=MsoNormal><b style='mso-bidi-font-weight:normal'>Store Ad (all Sales except TPR's) and Weekly
Ad (TPR's): <o:p></o:p></b></p>

<p class=MsoNormal style='text-indent:.25in'><b style='mso-bidi-font-weight:
normal'>Note: These steps will be required twice, once for the Store Ad and
again for the Weekly Ad<o:p></o:p></b></p>

<p class=MsoListParagraphCxSpFirst style='margin-bottom:10.0pt;mso-add-space:
auto;text-indent:.25in;line-height:115%;mso-list:l2 level1 lfo2'><![if !supportLists]><span
style='mso-bidi-font-family:Calibri;mso-bidi-theme-font:minor-latin'><span
style='mso-list:Ignore'>1.<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]>Open <span class=SpellE>RORC</span></p>

<p class=MsoListParagraphCxSpMiddle style='margin-bottom:10.0pt;mso-add-space:
auto;text-indent:.25in;line-height:115%;mso-list:l2 level1 lfo2'><![if !supportLists]><span
style='mso-bidi-font-family:Calibri;mso-bidi-theme-font:minor-latin'><span
style='mso-list:Ignore'>2.<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]>Enter login info, Sign In</p>

<p class=MsoListParagraphCxSpMiddle style='margin-bottom:10.0pt;mso-add-space:
auto;text-indent:.25in;line-height:115%;mso-list:l2 level1 lfo2'><![if !supportLists]><span
style='mso-bidi-font-family:Calibri;mso-bidi-theme-font:minor-latin'><span
style='mso-list:Ignore'>3.<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]>Open RORC Enhanced Reporting (contact your software provider if you don't have an icon on the desktop)</p>

<p class=MsoListParagraphCxSpMiddle style='margin-bottom:10.0pt;mso-add-space:
auto;text-indent:.25in;line-height:115%;mso-list:l2 level1 lfo2'><![if !supportLists]><span
style='mso-bidi-font-family:Calibri;mso-bidi-theme-font:minor-latin'><span
style='mso-list:Ignore'>4.<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]>Select Item Reports</p>

<p class=MsoListParagraphCxSpMiddle style='margin-bottom:10.0pt;mso-add-space:
auto;text-indent:.25in;line-height:115%;mso-list:l1 level1 lfo3'><![if !supportLists]><span
style='mso-bidi-font-family:Calibri;mso-bidi-theme-font:minor-latin'><span
style='mso-list:Ignore'>5.<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]>Select Markdown Item Price List</p>

<p class=MsoListParagraphCxSpMiddle style='margin-bottom:10.0pt;mso-add-space:
auto;text-indent:.25in;line-height:115%;mso-list:l2 level1 lfo2'><![if !supportLists]><span
style='mso-bidi-font-family:Calibri;mso-bidi-theme-font:minor-latin'><span
style='mso-list:Ignore'>6.<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]>Mark sure box is checked that says "Exclude Expired Pricing</p>

<p class=MsoListParagraphCxSpMiddle style='margin-bottom:10.0pt;mso-add-space:
auto;text-indent:.25in;line-height:115%;mso-list:l2 level1 lfo2'><![if !supportLists]><span
style='mso-bidi-font-family:Calibri;mso-bidi-theme-font:minor-latin'><span
style='mso-list:Ignore'>7.<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]>Above the "Exclude Expired Pricing" checkbox, Select "Show all but Base and TPR" for the Store Ad OR Select "TPR" for the Weekly Ad</p>

<p class=MsoListParagraphCxSpMiddle style='margin-bottom:10.0pt;mso-add-space:
auto;text-indent:.25in;line-height:115%;mso-list:l2 level1 lfo2'><![if !supportLists]><span
style='mso-bidi-font-family:Calibri;mso-bidi-theme-font:minor-latin'><span
style='mso-list:Ignore'>8.<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]>Select Submit</p>

<p class=MsoListParagraphCxSpMiddle style='margin-bottom:10.0pt;mso-add-space:
auto;text-indent:.25in;line-height:115%;mso-list:l2 level1 lfo2'><![if !supportLists]><span
style='mso-bidi-font-family:Calibri;mso-bidi-theme-font:minor-latin'><span
style='mso-list:Ignore'>9.<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;
</span></span></span><![endif]>Select Export to CSV</p>
						
<p class=MsoListParagraphCxSpMiddle style='margin-bottom:10.0pt;mso-add-space:
auto;text-indent:.25in;line-height:115%;mso-list:l2 level1 lfo2'><![if !supportLists]><span
style='mso-bidi-font-family:Calibri;mso-bidi-theme-font:minor-latin'><span
style='mso-list:Ignore'>10.<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;
</span></span></span><![endif]>Choose location to save the file and name file appropriately so you know <span
class=GramE>it’s</span> the Store Ad or Weekly Ad</p>

<p class=MsoListParagraphCxSpMiddle style='margin-bottom:10.0pt;mso-add-space:
auto;text-indent:.25in;line-height:115%;mso-list:l2 level1 lfo2'><![if !supportLists]><span
style='mso-bidi-font-family:Calibri;mso-bidi-theme-font:minor-latin'><span
style='mso-list:Ignore'>11.<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;
</span></span></span><![endif]>Click Save</p>

<p class=MsoNormal><b>Department List:<o:p></o:p></b></p>

<p class=MsoListParagraphCxSpFirst style='margin-bottom:10.0pt;mso-add-space:
auto;text-indent:.25in;line-height:115%;mso-list:l2 level1 lfo2'><![if !supportLists]><span
style='mso-bidi-font-family:Calibri;mso-bidi-theme-font:minor-latin'><span
style='mso-list:Ignore'>1.<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]>Open <span class=SpellE>RORC</span></p>

<p class=MsoListParagraphCxSpMiddle style='margin-bottom:10.0pt;mso-add-space:
auto;text-indent:.25in;line-height:115%;mso-list:l2 level1 lfo2'><![if !supportLists]><span
style='mso-bidi-font-family:Calibri;mso-bidi-theme-font:minor-latin'><span
style='mso-list:Ignore'>2.<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]>Enter login info, Sign In</p>

<p class=MsoListParagraphCxSpMiddle style='margin-bottom:10.0pt;mso-add-space:
auto;text-indent:.25in;line-height:115%;mso-list:l3 level1 lfo4'><![if !supportLists]><span
style='mso-bidi-font-family:Calibri;mso-bidi-theme-font:minor-latin'><span
style='mso-list:Ignore'>3.<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]>Open Control Files Section (near the bottom of the list)</p>

<p class=MsoListParagraphCxSpMiddle style='margin-bottom:10.0pt;mso-add-space:
auto;text-indent:.25in;line-height:115%;mso-list:l3 level1 lfo4'><![if !supportLists]><span
style='mso-bidi-font-family:Calibri;mso-bidi-theme-font:minor-latin'><span
style='mso-list:Ignore'>4.<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]>Click on Department</p>

<p class=MsoListParagraphCxSpMiddle style='margin-bottom:10.0pt;mso-add-space:
auto;text-indent:.25in;line-height:115%;mso-list:l3 level1 lfo4'><![if !supportLists]><span
style='mso-bidi-font-family:Calibri;mso-bidi-theme-font:minor-latin'><span
style='mso-list:Ignore'>5.<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]>Click on Print List</p>

<p class=MsoListParagraphCxSpLast style='margin-bottom:10.0pt;mso-add-space:
auto;text-indent:.25in;line-height:115%;mso-list:l3 level1 lfo4'><![if !supportLists]><span
style='mso-bidi-font-family:Calibri;mso-bidi-theme-font:minor-latin'><span
style='mso-list:Ignore'>7.<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]>Fill in the Department List Excel sheet that
can be downloaded from the <a style="display: inline" href="my_downloads.php" target="_blank" style="cursor: pointer">Download Files page</a></p>
						
<p class=MsoNormal><b>Exceptions File:<o:p></o:p></b></p>

<p class=MsoListParagraphCxSpLast style='margin-bottom:10.0pt;mso-add-space:
auto;text-indent:.25in;line-height:115%;mso-list:l3 level1 lfo4'><![if !supportLists]><span
style='mso-bidi-font-family:Calibri;mso-bidi-theme-font:minor-latin'><span
style='mso-list:Ignore'>1.<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]>Download the Exceptions file from the <a style="display: inline" href="my_downloads.php" target="_blank" style="cursor: pointer">Download Files page</a></p>

<p class=MsoListParagraphCxSpMiddle style='margin-bottom:10.0pt;mso-add-space:
auto;text-indent:.25in;line-height:115%;mso-list:l3 level1 lfo4'><![if !supportLists]><span
style='mso-bidi-font-family:Calibri;mso-bidi-theme-font:minor-latin'><span
style='mso-list:Ignore'>2.<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]>Add any items including their UPCs and Prices that you want to exclude from the error report</p>
<p class=MsoNormal><o:p>&nbsp;</o:p></p>
						
<div class="center">	
	<button type="button" onclick="javascript:window.close()">Close</button>
</div><br><br>
						
						<div class="row">
                            <div class="col-md-12">
                                <div class="copyright">
                                    <p>Copyright © 2021-<?php echo date("Y"); ?> Correct Prices LLC. All rights reserved. </p>
                                </div>
                            </div>
                        </div>

</div>
			 </div>
				</div>
			</div>
		</div>		
<?php include "include/footer-script.php"; ?>
</body>

</html>
<!-- end document-->
