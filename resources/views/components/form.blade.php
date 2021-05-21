@php
    if(!isset($shared['label_class'])){
        $shared['label_class'] = 'control-label col-md-3';
    }
    if(!isset($shared['label_for'])){
        $shared['label_for'] = '';
    }
    if(!isset($shared['label_required'])){
        $shared['label_required'] = false;
    }
    if(!isset($shared['label_title'])){
        $shared['label_title'] = 'Label';
    }
@endphp
@if($formType == "label")
    <label class="{{$shared['label_class']}}" for="{{$shared['label_for']}}">{{$shared['label_title']}}
        @if($shared['label_required'])
            <span class="required">*</span>
        @endif
    </label>
@endif
@php
    if(!isset($shared['input_class'])){
        $shared['input_class'] = 'form-control';
    }
    if(!isset($shared['input_type'])){
        $shared['input_type'] = 'text';
    }
    if(!isset($shared['input_name'])){
        $shared['input_name'] = 'input_name';
    }
    if(!isset($shared['input_value'])){
        $shared['input_value'] = '';
    }
    if(!isset($shared['input_id'])){
        $shared['input_id'] = $shared['input_name'];
    }

    if(!isset($shared['placeholder'])){
        $shared['placeholder'] = 'Input something';
    }
    if(isset($shared['required']) && $shared['required'] = true){
        $shared['required'] = 'required="required"';
    }else{
         $shared['required'] = '';
    }
     if(!isset($shared['selectOptions'])){
       $selectOptions = [];
    }else{
         //dd($shared['selectOptions']);
         $selectOptions = $shared['selectOptions'];
    }

@endphp
@if($formType == "formInput")
    <input id="{{$shared['input_id']}}" class="{{$shared['input_class']}}" name="{{$shared['input_name']}}"
           placeholder="{{$shared['placeholder']}}" value="{{old($shared['input_name'],$shared['input_value'])}}"
           {{$shared['required']}}
           type="{{$shared['input_type']}}">
@endif
@if($formType == "formSelect")
    <select name="{{$shared['input_name']}}" id="{{$shared['input_id']}}"
            class="{{$shared['input_class']}}" {{$shared['required']}}>
        @if(count($selectOptions) > 0)
            {{$defaultOption}}
            @foreach($selectOptions as $k=>$v)
                @if (old($shared['input_name']) == $k)
                    <option value="{{$k}}" selected>{{$v}}</option>
                @else
                    <option value="{{$k}}">{{$v}}</option>
                @endif
            @endforeach
        @endif
    </select>
@endif
