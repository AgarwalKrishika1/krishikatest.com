<Html>  
    <Head>  
    <title> File Upload </title>  
    </Head>  
    <Body>  
    <form method="Post" action="{{route('form.store')}}" enctype="multipart/form-data">  
    @csrf  
    <div><input type="file" name="image"> </div><br/>  
    <div><button type="submit">Upload </button></div>  
      
    </form>  
    </body>  
</Html>