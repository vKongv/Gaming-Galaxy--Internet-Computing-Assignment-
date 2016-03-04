
    <form action="input.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="MAX_FILESIZE" value="200000"/>    
    Select image to upload: <label>File: </label>
    <input type="file" name="image" accept="image/jpeg"/>
    <br/>
    <br/>
     Please Enter Game Name  :
    <input type="text" name="GameName">
     <br/>
     <br/>
     Please Enter Author Name:
    <input type="text" name="AuthorName">
     <br/>
     <br/>
     Please Enter Articles:
     <br/>
    <textarea name="Articles" rows="5" cols="40"></textarea>
     <br/>
     Rating: <select name ="Rating">
         <option>1</option>
         <option>2</option>
         <option>3</option>
         <option>4</option>
         <option>5</option>   
     </select>
     
     <input type="hidden" value='$Id'>
     <input type="submit" value="Submit" name="submit" >
    
     
    </form>
   
        