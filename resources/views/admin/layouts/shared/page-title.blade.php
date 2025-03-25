<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                @if(isset($breadcrumb))
                <ol class="breadcrumb m-0">
                    @foreach($breadcrumb as $bred)
                    <li class="breadcrumb-item"><a href="javascript: void(0);">{{ $bred }}</a></li>
                    @endforeach
                </ol>
                @endif
            </div>
            <h4 class="page-title">{{ $page_title }}</h4>
        </div>
    </div>
</div>
<!-- end page title -->