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
the Required Pricing Data from ScanMaster<o:p></o:p></span></u></b></h2>

<p class=MsoNormal><b style='mso-bidi-font-weight:normal'>Store Pricing Data:<o:p></o:p></b></p>

<p class=MsoListParagraphCxSpFirst style='margin-bottom:10.0pt;mso-add-space:
auto;text-indent:.25in;line-height:115%;mso-list:l2 level1 lfo2'><![if !supportLists]><span
style='mso-bidi-font-family:Calibri;mso-bidi-theme-font:minor-latin'><span
style='mso-list:Ignore'>1.<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]>Open <span class=SpellE>Scanmaster</span></p>

<p class=MsoListParagraphCxSpMiddle style='margin-bottom:10.0pt;mso-add-space:
auto;text-indent:.25in;line-height:115%;mso-list:l2 level1 lfo2'><![if !supportLists]><span
style='mso-bidi-font-family:Calibri;mso-bidi-theme-font:minor-latin'><span
style='mso-list:Ignore'>2.<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]>Enter login info, then hit enter</p>

<p class=MsoListParagraphCxSpMiddle style='margin-bottom:10.0pt;mso-add-space:
auto;text-indent:.25in;line-height:115%;mso-list:l2 level1 lfo2'><![if !supportLists]><span
style='mso-bidi-font-family:Calibri;mso-bidi-theme-font:minor-latin'><span
style='mso-list:Ignore'>3.<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]>Select Report Menus</p>

<p class=MsoListParagraphCxSpMiddle style='margin-bottom:10.0pt;mso-add-space:
auto;text-indent:.25in;line-height:115%;mso-list:l2 level1 lfo2'><![if !supportLists]><span
style='mso-bidi-font-family:Calibri;mso-bidi-theme-font:minor-latin'><span
style='mso-list:Ignore'>4.<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]>Select Item File Reports</p>

<p class=MsoListParagraphCxSpMiddle style='margin-bottom:10.0pt;mso-add-space:
auto;text-indent:.25in;line-height:115%;mso-list:l2 level1 lfo2'><![if !supportLists]><span
style='mso-bidi-font-family:Calibri;mso-bidi-theme-font:minor-latin'><span
style='mso-list:Ignore'>5.<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]>Select PLU Movement Report</p>

<p class=MsoListParagraphCxSpMiddle style='margin-bottom:10.0pt;mso-add-space:
auto;text-indent:.25in;line-height:115%;mso-list:l2 level1 lfo2'><![if !supportLists]><span
style='mso-bidi-font-family:Calibri;mso-bidi-theme-font:minor-latin'><span
style='mso-list:Ignore'>6.<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]>Under Period to Use for Report choose “Since
Last Change”</p>

<p class=MsoListParagraphCxSpMiddle style='margin-bottom:10.0pt;mso-add-space:
auto;text-indent:.25in;line-height:115%;mso-list:l2 level1 lfo2'><![if !supportLists]><span
style='mso-bidi-font-family:Calibri;mso-bidi-theme-font:minor-latin'><span
style='mso-list:Ignore'>7.<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]>Click on Create</p>

<p class=MsoListParagraphCxSpMiddle style='margin-bottom:10.0pt;mso-add-space:
auto;text-indent:.25in;line-height:115%;mso-list:l2 level1 lfo2'><![if !supportLists]><span
style='mso-bidi-font-family:Calibri;mso-bidi-theme-font:minor-latin'><span
style='mso-list:Ignore'>8.<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]>Click on icon for Export Report (envelope with
arrow pointing into the top of it)</p>

<p class=MsoListParagraphCxSpMiddle style='margin-bottom:10.0pt;mso-add-space:
auto;text-indent:.25in;line-height:115%;mso-list:l2 level1 lfo2'><![if !supportLists]><span
style='mso-bidi-font-family:Calibri;mso-bidi-theme-font:minor-latin'><span
style='mso-list:Ignore'>9.<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]>Under Format, choose “MS-Excel 97-2000 (Data
Only)</p>

<p class=MsoListParagraphCxSpMiddle style='margin-bottom:10.0pt;mso-add-space:
auto;text-indent:.25in;line-height:115%;mso-list:l2 level1 lfo2'><![if !supportLists]><span
style='mso-bidi-font-family:Calibri;mso-bidi-theme-font:minor-latin'><span
style='mso-list:Ignore'>10.<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;
</span></span></span><![endif]>Click on OK</p>

<p class=MsoListParagraphCxSpMiddle style='margin-bottom:10.0pt;mso-add-space:
auto;text-indent:.25in;line-height:115%;mso-list:l2 level1 lfo2'><![if !supportLists]><span
style='mso-bidi-font-family:Calibri;mso-bidi-theme-font:minor-latin'><span
style='mso-list:Ignore'>11.<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;
</span></span></span><![endif]>Under Column Width, select column width based on
objects in the: Details</p>

<p class=MsoListParagraphCxSpMiddle style='margin-bottom:10.0pt;mso-add-space:
auto;text-indent:.25in;line-height:115%;mso-list:l2 level1 lfo2'><![if !supportLists]><span
style='mso-bidi-font-family:Calibri;mso-bidi-theme-font:minor-latin'><span
style='mso-list:Ignore'>12.<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;
</span></span></span><![endif]>Make sure there is a checkmark by “Export Page
Header and Page Footer”</p>

<p class=MsoListParagraphCxSpMiddle style='margin-bottom:10.0pt;mso-add-space:
auto;text-indent:.25in;line-height:115%;mso-list:l2 level1 lfo2'><![if !supportLists]><span
style='mso-bidi-font-family:Calibri;mso-bidi-theme-font:minor-latin'><span
style='mso-list:Ignore'>13.<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;
</span></span></span><![endif]>Make sure there is a checkmark by “Simplify page
headers”</p>

<p class=MsoListParagraphCxSpMiddle style='margin-bottom:10.0pt;mso-add-space:
auto;text-indent:.25in;line-height:115%;mso-list:l2 level1 lfo2'><![if !supportLists]><span
style='mso-bidi-font-family:Calibri;mso-bidi-theme-font:minor-latin'><span
style='mso-list:Ignore'>14.<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;
</span></span></span><![endif]>Click on OK</p>
						
<p class=MsoListParagraphCxSpMiddle style='margin-bottom:10.0pt;mso-add-space:
auto;text-indent:.25in;line-height:115%;mso-list:l2 level1 lfo2'><![if !supportLists]><span
style='mso-bidi-font-family:Calibri;mso-bidi-theme-font:minor-latin'><span
style='mso-list:Ignore'>15.<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;
</span></span></span><![endif]>Save file to destination (choose place to save)</p>

<p class=MsoListParagraphCxSpMiddle style='margin-bottom:10.0pt;mso-add-space:
auto;text-indent:.25in;line-height:115%;mso-list:l2 level1 lfo2'><![if !supportLists]><span
style='mso-bidi-font-family:Calibri;mso-bidi-theme-font:minor-latin'><span
style='mso-list:Ignore'>16.<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;
</span></span></span><![endif]>Name file appropriately so you know <span
class=GramE>it’s</span> the store pricing data</p>

<p class=MsoListParagraphCxSpLast style='margin-bottom:10.0pt;mso-add-space:
auto;text-indent:.25in;line-height:115%;mso-list:l2 level1 lfo2'><![if !supportLists]><span
style='mso-bidi-font-family:Calibri;mso-bidi-theme-font:minor-latin'><span
style='mso-list:Ignore'>17.<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;
</span></span></span><![endif]>Click on Save</p>

<p class=MsoNormal><b style='mso-bidi-font-weight:normal'>Store Ad and Weekly
Ad: <o:p></o:p></b></p>

<p class=MsoNormal style='text-indent:.25in'><b style='mso-bidi-font-weight:
normal'>Note: These steps will be required twice, once for the Store Ad and
again for the Weekly Ad<o:p></o:p></b></p>

<p class=MsoListParagraphCxSpFirst style='margin-bottom:10.0pt;mso-add-space:
auto;text-indent:.25in;line-height:115%;mso-list:l1 level1 lfo3'><![if !supportLists]><span
style='mso-bidi-font-family:Calibri;mso-bidi-theme-font:minor-latin'><span
style='mso-list:Ignore'>1.<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]>Open <span class=SpellE>Scanmaster</span></p>

<p class=MsoListParagraphCxSpMiddle style='margin-bottom:10.0pt;mso-add-space:
auto;text-indent:.25in;line-height:115%;mso-list:l1 level1 lfo3'><![if !supportLists]><span
style='mso-bidi-font-family:Calibri;mso-bidi-theme-font:minor-latin'><span
style='mso-list:Ignore'>2.<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]>Enter login info, then hit enter</p>

<p class=MsoListParagraphCxSpMiddle style='margin-bottom:10.0pt;mso-add-space:
auto;text-indent:.25in;line-height:115%;mso-list:l1 level1 lfo3'><![if !supportLists]><span
style='mso-bidi-font-family:Calibri;mso-bidi-theme-font:minor-latin'><span
style='mso-list:Ignore'>3.<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]>Select Report Menus</p>

<p class=MsoListParagraphCxSpMiddle style='margin-bottom:10.0pt;mso-add-space:
auto;text-indent:.25in;line-height:115%;mso-list:l1 level1 lfo3'><![if !supportLists]><span
style='mso-bidi-font-family:Calibri;mso-bidi-theme-font:minor-latin'><span
style='mso-list:Ignore'>4.<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]>Select Item File Reports</p>

<p class=MsoListParagraphCxSpMiddle style='margin-bottom:10.0pt;mso-add-space:
auto;text-indent:.25in;line-height:115%;mso-list:l1 level1 lfo3'><![if !supportLists]><span
style='mso-bidi-font-family:Calibri;mso-bidi-theme-font:minor-latin'><span
style='mso-list:Ignore'>5.<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]>Select PLU File Report</p>

<p class=MsoListParagraphCxSpMiddle style='margin-bottom:10.0pt;mso-add-space:
auto;text-indent:.25in;line-height:115%;mso-list:l1 level1 lfo3'><![if !supportLists]><span
style='mso-bidi-font-family:Calibri;mso-bidi-theme-font:minor-latin'><span
style='mso-list:Ignore'>6.<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]>Enter proper levels under Ad Level (starting and
ending)</p>

<p class=MsoListParagraphCxSpMiddle style='margin-bottom:10.0pt;mso-add-space:
auto;text-indent:.25in;line-height:115%;mso-list:l1 level1 lfo3'><![if !supportLists]><span
style='mso-bidi-font-family:Calibri;mso-bidi-theme-font:minor-latin'><span
style='mso-list:Ignore'>7.<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]>Click on Create</p>

<p class=MsoListParagraphCxSpMiddle style='margin-bottom:10.0pt;mso-add-space:
auto;text-indent:.25in;line-height:115%;mso-list:l1 level1 lfo3'><![if !supportLists]><span
style='mso-bidi-font-family:Calibri;mso-bidi-theme-font:minor-latin'><span
style='mso-list:Ignore'>8.<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]>Click on icon for Export Report (envelope with
arrow pointing into the top of it)</p>

<p class=MsoListParagraphCxSpMiddle style='margin-bottom:10.0pt;mso-add-space:
auto;text-indent:.25in;line-height:115%;mso-list:l1 level1 lfo3'><![if !supportLists]><span
style='mso-bidi-font-family:Calibri;mso-bidi-theme-font:minor-latin'><span
style='mso-list:Ignore'>9.<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]>Under Format, choose “MS-Excel 97-2000 (Data
Only)</p>

<p class=MsoListParagraphCxSpMiddle style='margin-bottom:10.0pt;mso-add-space:
auto;text-indent:.25in;line-height:115%;mso-list:l1 level1 lfo3'><![if !supportLists]><span
style='mso-bidi-font-family:Calibri;mso-bidi-theme-font:minor-latin'><span
style='mso-list:Ignore'>10.<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;
</span></span></span><![endif]>Click on OK</p>

<p class=MsoListParagraphCxSpMiddle style='margin-bottom:10.0pt;mso-add-space:
auto;text-indent:.25in;line-height:115%;mso-list:l1 level1 lfo3'><![if !supportLists]><span
style='mso-bidi-font-family:Calibri;mso-bidi-theme-font:minor-latin'><span
style='mso-list:Ignore'>11.<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;
</span></span></span><![endif]>Under Column Width, select column width based on
objects in the: Details</p>

<p class=MsoListParagraphCxSpMiddle style='margin-bottom:10.0pt;mso-add-space:
auto;text-indent:.25in;line-height:115%;mso-list:l1 level1 lfo3'><![if !supportLists]><span
style='mso-bidi-font-family:Calibri;mso-bidi-theme-font:minor-latin'><span
style='mso-list:Ignore'>12.<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;
</span></span></span><![endif]>Make sure there is a checkmark by “Export Page
Header and Page Footer”</p>

<p class=MsoListParagraphCxSpMiddle style='margin-bottom:10.0pt;mso-add-space:
auto;text-indent:.25in;line-height:115%;mso-list:l1 level1 lfo3'><![if !supportLists]><span
style='mso-bidi-font-family:Calibri;mso-bidi-theme-font:minor-latin'><span
style='mso-list:Ignore'>13.<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;
</span></span></span><![endif]>Make sure there is a checkmark by “Simplify page
headers”</p>

<p class=MsoListParagraphCxSpMiddle style='margin-bottom:10.0pt;mso-add-space:
auto;text-indent:.25in;line-height:115%;mso-list:l2 level1 lfo2'><![if !supportLists]><span
style='mso-bidi-font-family:Calibri;mso-bidi-theme-font:minor-latin'><span
style='mso-list:Ignore'>14.<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;
</span></span></span><![endif]>Click on OK</p>
						
<p class=MsoListParagraphCxSpMiddle style='margin-bottom:10.0pt;mso-add-space:
auto;text-indent:.25in;line-height:115%;mso-list:l2 level1 lfo2'><![if !supportLists]><span
style='mso-bidi-font-family:Calibri;mso-bidi-theme-font:minor-latin'><span
style='mso-list:Ignore'>15.<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;
</span></span></span><![endif]>Save file to destination (choose place to save)</p>

<p class=MsoListParagraphCxSpMiddle style='margin-bottom:10.0pt;mso-add-space:
auto;text-indent:.25in;line-height:115%;mso-list:l1 level1 lfo3'><![if !supportLists]><span
style='mso-bidi-font-family:Calibri;mso-bidi-theme-font:minor-latin'><span
style='mso-list:Ignore'>16.<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;
</span></span></span><![endif]>Name files appropriately so you know can
distinguish between the Store Ad and Weekly Ad</p>

<p class=MsoListParagraphCxSpLast style='margin-bottom:10.0pt;mso-add-space:
auto;text-indent:.25in;line-height:115%;mso-list:l1 level1 lfo3'><![if !supportLists]><span
style='mso-bidi-font-family:Calibri;mso-bidi-theme-font:minor-latin'><span
style='mso-list:Ignore'>17.<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;
</span></span></span><![endif]>Click on Save</p>

<p class=MsoNormal><b>Department List:<o:p></o:p></b></p>

<p class=MsoListParagraphCxSpFirst style='margin-bottom:10.0pt;mso-add-space:
auto;text-indent:.25in;line-height:115%;mso-list:l3 level1 lfo4'><![if !supportLists]><span
style='mso-bidi-font-family:Calibri;mso-bidi-theme-font:minor-latin'><span
style='mso-list:Ignore'>1.<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]>Open <span class=SpellE>Scanmaster</span></p>

<p class=MsoListParagraphCxSpMiddle style='margin-bottom:10.0pt;mso-add-space:
auto;text-indent:.25in;line-height:115%;mso-list:l3 level1 lfo4'><![if !supportLists]><span
style='mso-bidi-font-family:Calibri;mso-bidi-theme-font:minor-latin'><span
style='mso-list:Ignore'>2.<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]>Enter login info, then hit enter</p>

<p class=MsoListParagraphCxSpMiddle style='margin-bottom:10.0pt;mso-add-space:
auto;text-indent:.25in;line-height:115%;mso-list:l3 level1 lfo4'><![if !supportLists]><span
style='mso-bidi-font-family:Calibri;mso-bidi-theme-font:minor-latin'><span
style='mso-list:Ignore'>3.<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]>Select Department / <span class=SpellE>Subdept</span>
Maintenance</p>

<p class=MsoListParagraphCxSpMiddle style='margin-bottom:10.0pt;mso-add-space:
auto;text-indent:.25in;line-height:115%;mso-list:l3 level1 lfo4'><![if !supportLists]><span
style='mso-bidi-font-family:Calibri;mso-bidi-theme-font:minor-latin'><span
style='mso-list:Ignore'>4.<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]>Select Department Maintenance</p>

<p class=MsoListParagraphCxSpMiddle style='margin-bottom:10.0pt;mso-add-space:
auto;text-indent:.25in;line-height:115%;mso-list:l3 level1 lfo4'><![if !supportLists]><span
style='mso-bidi-font-family:Calibri;mso-bidi-theme-font:minor-latin'><span
style='mso-list:Ignore'>5.<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]>Click on Print List</p>

<p class=MsoListParagraphCxSpMiddle style='margin-bottom:10.0pt;mso-add-space:
auto;text-indent:.25in;line-height:115%;mso-list:l3 level1 lfo4'><![if !supportLists]><span
style='mso-bidi-font-family:Calibri;mso-bidi-theme-font:minor-latin'><span
style='mso-list:Ignore'>6.<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]>Click on Print</p>

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
