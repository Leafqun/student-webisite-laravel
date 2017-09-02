<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<div>
    <form action="http://localhost:8000/notice/submitNotice" enctype="multipart/form-data" method="post">
        <input name="noticeName" type="text">
        <input name="content">
        <input type="file" name="cfile">
        <input type="hidden" value="12" name="noticeId">
        <input type="hidden" value="img1.png" name="file">
        <button>submit</button>
    </form>
</div>
</body>
</html>