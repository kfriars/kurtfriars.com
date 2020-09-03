@foreach ($element['bullets'] as $bullet)
    <div style="padding-left:1.5rem;margin-bottom:16px;line-height:24px">
        <img src="{{ mail_asset($element['img']) }}" width="18" height="18" style="outline:none;text-decoration:none;width:18px;float:left;margin-top:3px;margin-right:1rem" class="CToWUd">
        <span style="display:block;margin-left:2.1rem">
            {{ $bullet }}
        </span>
    </div>
@endforeach