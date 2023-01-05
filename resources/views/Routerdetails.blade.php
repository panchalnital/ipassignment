<!DOCTYPE html>
<html>

<head>
<title>Assignment (with internet access for reference).</title>
<meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/jquery-editable/css/jquery-editable.css" rel="stylesheet"/>
    <script>$.fn.poshytip={defaults:null}</script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/jquery-editable/js/jquery-editable-poshytip.min.js"></script>
</head>
<body>
     
<div class="container">
    <div class="card mt-3 mb-3">
        <div class="card-header text-center">
            <h4>PHP Practical Assignment.</h4>
        </div>
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <div class="card-body">
            <form action="{{ route('routerdetail.import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="file" name="file" class="form-control" required>
                <br>
                <button class="btn btn-primary">Import User Data</button>
            </form>
  
            <table class="table table-bordered mt-3">
                <tr>
                    <th colspan="3">
                        
                    </th>
                </tr>
                <tr>
                    <th>ID</th>
                    <th>SAPID</th>
                    <th>HOSTNAME</th>
                    <th>LOOPBACK</th>
                    <th>MAC ADDRESSS</th>
                    <th> </th>
                </tr>
                @foreach($routerdetails as $routerdetail)
                <tr>
                    <td>
                    {{$routerdetail->id }}
                    </td>
                    <td>
                    <a href="" class="update" data-name="sapid" id="mac_sapid" data-sapid='{{ $routerdetail->sapid }}'  data-type="text" data-pk="{{ $routerdetail->id }}" data-title="Enter sapid">{{ $routerdetail->sapid }}</a>
                    </td>
                    <td>
                    <a href="" class="update" data-name="hostname" id="mac_hostname" data-hostname='{{ $routerdetail->loopback }}' data-type="text" data-pk="{{ $routerdetail->id }}" data-title="Enter hostname">{{ $routerdetail->hostname }}</a>
                    </td>
                    <td>
                    <a href="" class="update" data-name="loopback" id="mac_loopback" data-loopback='{{ $routerdetail->loopback }}' data-type="text" data-pk="{{ $routerdetail->id }}" data-title="Enter loopback">{{ $routerdetail->loopback }}</a>
                    </td>
                    <td>
                    <a href="" class="update" data-name="mac_address" id="mac_address" data-macaddress='{{ $routerdetail->mac_address }}' data-type="text" data-pk="{{ $routerdetail->id }}" data-title="Enter mac_address">{{ $routerdetail->mac_address }}</a>
                    </td>
                    <td> 
                        <form method="post" action="{{route('routerdetail.delete',$routerdetail->id)}}">
                            @method('delete')
                            @csrf
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </table>
            
            <h5>Pagination:</h5>
            {{ $routerdetails->links() }}
            
        </div>
    </div>
</div>
     
</body>
<script type="text/javascript">
    $.fn.editable.defaults.mode = 'inline';
  
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': '{{csrf_token()}}'
        }
    }); 
  
    $('.update').editable({
           url: "{{ route('routerdetail.update') }}",
           type: 'text',
           pk: 1,
           name: 'name',
           title: 'Enter name'
    });

    $(document).on("ready", function(){
        $("#mac_address").each(function(index, element){
            var $this = $(element);
            var regex = /^([0-9A-F]{2}[:-]){5}([0-9A-F]{2})$/;
                if(!regex.test($this.attr("data-macaddress"))){
                    $this.css("color", "red");
                }          
        });

        $("#mac_loopback").each(function(index, element){
            var $this = $(element);
            var regex = /^(([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])\.){3}([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])$/;
                if(!regex.test($this.attr("data-loopback"))){
                    $this.css("color", "red");
                }                    
        });

        $("#mac_hostname").each(function(index, element){
            var $this = $(element);
            var regex = /^([0-9A-F]{2}[:-]){5}([0-9A-F]{2})$/;
                if(!isValidUrl($this.attr("data-macaddress"))){
                    $this.css("color", "red");
                }        
        });

        $("#mac_sapid").each(function(index, element){
            var $this = $(element);
           // checkSapid($this.attr("data-sapid"));            
        });
    });

    const isValidUrl = urlString=> {
	  	var urlPattern = new RegExp('^(https?:\\/\\/)?'+ // validate protocol
	    '((([a-z\\d]([a-z\\d-]*[a-z\\d])*)\\.)+[a-z]{2,}|'+ // validate domain name
	    '((\\d{1,3}\\.){3}\\d{1,3}))'+ // validate OR ip (v4) address
	    '(\\:\\d+)?(\\/[-a-z\\d%_.~+]*)*'+ // validate port and path
	    '(\\?[;&a-z\\d%_.~+=-]*)?'+ // validate query string
	    '(\\#[-a-z\\d_]*)?$','i'); // validate fragment locator
	  return !!urlPattern.test(urlString);
	}

</script>
</html>
<!DOCTYPE html>

