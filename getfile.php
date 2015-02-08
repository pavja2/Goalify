<html>
<head>
<title>Process Uploaded File</title>
</head>
<body>
<?php
if ( move_uploaded_file ($_FILES['uploadFile'] ['tmp_name'], 
       "../uploads/{$_FILES['uploadFile'] ['name']}")  )
      {  print '<p> The file has been successfully uploaded </p>';
       }
else
      { 
        switch ($_FILES['uploadFile'] ['error'])
         {  case 1:
                   print '<p> The file is bigger than this PHP installation allows</p>';
                   break;
            case 2:
                   print '<p> The file is bigger than this form allows</p>';
                   break;
            case 3:
                   print '<p> Only part of the file was uploaded</p>';
                   break;
            case 4:
                   print '<p> No file was uploaded</p>';
                   break;
         }
       }
?>
</body>
</html>
