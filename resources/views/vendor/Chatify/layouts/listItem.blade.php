
@php
$setting = App\Models\Utility::getAdminPaymentSettings();
if ($setting['color']) {
    $color = $setting['color'];
    
}
else{
  $color = 'theme-3';  
}
@endphp

@php
$logo   = \App\Models\Utility::get_file('/');
$avatar = \App\Models\Utility::get_file('/avatars/');
@endphp

 {{-- -------------------- Saved Messages -------------------- --}}
@if($get == 'saved')
    <table class="messenger-list-item m-li-divider @if('user_'.Auth::user()->id == $id && $id != "0") m-list-active @endif">
        <tr data-action="0">
            {{-- Avatar side --}}
            <td>
            @if($color == "theme-1")
            <div class="avatar av-m" style="background-color: #d9efff; text-align: center;">
                <span class="far fa-bookmark" style="font-size: 22px; color: #51459d; margin-top: 12px !important;"></span>
            </div>
            @endif
             @if($color == "theme-2")
            <div class="avatar av-m" style="background-color: #d9efff; text-align: center;">
                <span class="far fa-bookmark" style="font-size: 22px; color: #1f3996; margin-top: 12px !important;"></span>
            </div>
            @endif
             @if($color == "theme-3")
            <div class="avatar av-m" style="background-color: #d9efff; text-align: center;">
                <span class="far fa-bookmark" style="font-size: 22px; color: #6fd943; margin-top: 12px !important;"></span>
            </div>
            @endif
             @if($color == "theme-4")
            <div class="avatar av-m" style="background-color: #d9efff; text-align: center;">
                <span class="far fa-bookmark" style="font-size: 22px; color: #584ed2; margin-top: 12px !important;"></span>
            </div>
            @endif

            </td>
            {{-- center side --}}
            <td>
                <p data-id="{{ 'user_'.Auth::user()->id }}">Saved Messages <span>You</span></p>
                <span>Save messages secretly</span>
            </td>
        </tr>
    </table>
@endif

{{-- -------------------- All users/group list -------------------- --}}
@if($get == 'users')
<table class="messenger-list-item @if($user->id == $id && $id != "0") m-list-active @endif" data-contact="{{ $user->id }}">
    <tr data-action="0">
        {{-- Avatar side --}}
        <td style="position: relative">
            @if($user->active_status)
                <span class="activeStatus"></span>
            @endif
                 @if(!empty($user->avatar))
        <div class="avatar av-m" 
        style="background-image: url('{{$avatar.$user->avatar}}');">
        </div>
          @else
         <div class="avatar av-m"
                         style="background-image: url('{{$avatar.'avatar.png'}}');">
                    </div>
                @endif
        </td>
        
        <td>
        <p data-id="{{ $type.'_'.$user->id }}">
            {{ strlen($user->name) > 12 ? trim(substr($user->name,0,12)).'..' : $user->name }} 
            <span>{{ $lastMessage->created_at->diffForHumans() }}</span></p>
        <span>
           
            {!!
                $lastMessage->from_id == Auth::user()->id 
                ? '<span class="lastMessageIndicator">You :</span>'
                : ''
            !!}
            {{-- Last message body --}}
            @if($lastMessage->attachment == null)
            {{
                strlen($lastMessage->body) > 30 
                ? trim(substr($lastMessage->body, 0, 30)).'..'
                : $lastMessage->body
            }}
            @else
            <span class="fas fa-file"></span> Attachment
            @endif
        </span>
       
            {!! $unseenCounter > 0 ? "<b>".$unseenCounter."</b>" : '' !!}
        </td>
        
    </tr>
</table>
@endif

{{-- -------------------- Search Item -------------------- --}}
@if($get == 'search_item')
<table class="messenger-list-item" data-contact="{{ $user->id }}">
    <tr data-action="0">
        {{-- Avatar side --}}
            <td style="position: relative">
             @if($user->active_status)
                    <span class="activeStatus"></span>
                @endif
                {{-- @dd($user) --}}
                 @if(!empty($user->avatar))  
                    <div class="avatar av-m"
                    style="background-image:url('{{asset($avatar.$user->avatar)}}');">
                    </div> 
                @else
                    {{-- @dd($user->avatar)  --}}
                    <div class="avatar av-m"
                                    style="background-image: url('{{asset($avatar.'avatar.png')}}');">
                                </div>
                @endif
        </td>
        {{-- center side --}}
        <td>
        <p data-id="{{ $type.'_'.$user->id }}">
            {{ strlen($user->name) > 12 ? trim(substr($user->name,0,12)).'..' : $user->name }} 
        </td>
        
    </tr>
</table>
@endif



{{-- -------------------- Get All Members -------------------- --}}

@if($get == 'all_members')
    <table class="messenger-list-item" data-contact="{{ $user->id }}">
        <tr data-action="0">
            {{-- Avatar side --}}
            <td style="position: relative">
                @if($user->active_status)
                    <span class="activeStatus"></span>
                @endif
                @if(!empty($user->avatar))
                    <div class="avatar av-m"
                         style="background-image: url('{{$avatar.$user->avatar}}');">
                    </div>
                @else
                    <div class="avatar av-m"
                         style="background-image: url('{{$avatar.'avatar.png'}}');">
                    </div>
                @endif
            </td>
            {{-- center side --}}
            <td>
                <p data-id="{{ $type.'_'.$user->id }}">
                {{ strlen($user->name) > 12 ? trim(substr($user->name,0,12)).'..' : $user->name }}
            </td>

        </tr>
    </table>
@endif

{{-- -------------------- Shared photos Item -------------------- --}}
@if($get == 'sharedPhoto')
<div class="shared-photo chat-image" style="background-image: url('{{ $image }}')"></div>
@endif




 

