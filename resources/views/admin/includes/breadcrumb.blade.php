<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                @if(isset($breadcrumb))
                <ol class="breadcrumb m-0">
                    @foreach($breadcrumb as $bkey => $b_value)
                        <?php end($breadcrumb); ?>
                        @if($bkey==key($breadcrumb))
                            <li class="breadcrumb-item active">{{$bkey}}</li>
                        @elseif($b_value!="")
                           <li class="breadcrumb-item"><a href="{{url($b_value)}}">{{$bkey}}</a></li>
                        @else
                        <li class="breadcrumb-item"><a href="javascript: void(0);">{{$bkey}}</a></li>
                        @endif
                    @endforeach
                </ol>
                @endif
            </div>
            <h4 class="page-title">{{ (isset($page_title)?$page_title:'' ) }}</h4>
        </div>
    </div>
</div>
<!-- end page title -->