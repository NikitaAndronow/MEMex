<center>

    <button id="showAdd">add card</button>
    <button id="showDel">delete card</button>
    

    <div id="add">

        <form action="admin/run">
            <label class='iField'>Number  </label>
            <div id="errorNum" class="error"></div><input id="idInputNumber" type="number" min="0" step="1" max="99" name="Num" placeholder="num" required autofocus>
            <label class='iField'>Hero</label><input id="idInputHero" type="text" name="Hero" placeholder="hero" required><br>
            <label class='iField'>Action</label><input id="idInputAction" type="text" name="Action" placeholder="Action" required><br>
            <label class='iField'>Item</label><input id="idInputItem" type="text" name=Item placeholder="Item" required><br>
        </form>



        <label class='iField'>Select <strong>Hero</strong> to upload  </label>
        <form id="insertHero" action="upload.php" method="post" enctype="multipart/form-data">
            <input type="file" name="fileToUpload" id="fileToUpload"> </form>

        <label class='iField'>Select <strong>Action</strong> to upload  </label>
        <form id="insertAction" action="upload.php" method="post" enctype="multipart/form-data">
            <input type="file" name="fileToUpload" id="fileToUpload"> </form>

        <label class='iField'>Select <strong>Item</strong> to upload  </label>
        <form id="insertItem" action="upload.php" method="post" enctype="multipart/form-data">
            <input type="file" name="fileToUpload" id="fileToUpload"> </form>

        <img id="imgHero" src="../../public/img/test/../normal.png" width="100px" heigh="100px" alt="1.jpg">
        <img id="imgAction" src="../../public/img/test/../normal.png" width="100px" heigh="100px" alt="1.jpg">
        <img id="imgItem" src="../../public/img/test/../normal.png" width="100px" heigh="100px" alt="1.jpg">
        <button id="saveAll" class='studyButt checkButt' style=" top:0px; "><span>saves</span></button>
    </div>
    <div id="delete">
    
    <form style="margin:20px"action="admin/delete">
         <label class='iField'>Number  </label>
            <div id="errorDelNum" class="error"></div>
            <select id="idInputDelNumber" >
        </select>
           
        
    </form>
     <button id="DelNumButt" class='studyButt checkButt' style=" top:0px; "><span>saves</span></button>
    
    </div>
    

</center>
