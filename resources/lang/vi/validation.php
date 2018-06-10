<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted'             => ':attribute phải được chấp nhận.',
    'active_url'           => ':attribute không phải là URL hợp lệ.',
    'after'                => ':attribute phải là một ngày sau :date.',
    'after_or_equal'       => ':attribute phải là ngày sau hoặc bằng :date.',
    'alpha'                => ':attribute chỉ có thể chứa chữ cái.',
    'alpha_dash'           => ':attribute chỉ có thể chứa chữ cái, số và dấu gạch ngang.',
    'alpha_num'            => ':attribute chỉ có thể chứa chữ cái và số.',
    'array'                => ':attribute phải là một mảng.',
    'before'               => ':attribute phải là một ngày trước :date.',
    'before_or_equal'      => ':attribute phải là ngày trước hoặc bằng :date.',
    'between'              => [
        'numeric' => ':attribute phải ở giữa :min và :max.',
        'file'    => ':attribute phải ở giữa :min và :max kilobyte.',
        'string'  => ':attribute phải ở giữa :min và :max ký tự.',
        'array'   => ':attribute phải có giữa :min và :max khoản mục.',
    ],
    'boolean'              => ':attribute trường phải đúng hoặc sai.',
    'confirmed'            => ':attribute nhận định không phù hợp.',
    'date'                 => ':attribute không phải là ngày hợp lệ.',
    'date_format'          => ':attribute không khớp với định dạng :format.',
    'different'            => ':attribute và :other phải khác.',
    'digits'               => ':attribute cần phải :digits digits.',
    'digits_between'       => ':attribute phải ở giữa :min và :max digits.',
    'dimensions'           => ':attribute có kích thước hình ảnh không hợp lệ.',
    'distinct'             => ':attribute trường có một giá trị trùng lặp.',
    'email'                => ':attribute phải có một địa chỉ email hợp lệ.',
    'exists'               => ':attribute đã chọn không hợp lệ.',
    'file'                 => ':attribute phải là một tập tin.',
    'filled'               => ':attribute trường phải có giá trị.',
    'image'                => ':attribute phải là một hình ảnh.',
    'in'                   => ':attribute đã chọn không hợp lệ.',
    'in_array'             => ':attribute trường không tồn tại :other.',
    'integer'              => ':attribute phải là một số nguyên.',
    'ip'                   => ':attribute phải có một địa chỉ IP hợp lệ.',
    'ipv4'                 => ':attribute phải có một địa chỉ IPv4 hợp lệ.',
    'ipv6'                 => ':attribute phải có một địa chỉ IPv6 hợp lệ.',
    'json'                 => ':attribute phải là một chuỗi JSON hợp lệ.',
    'max'                  => [
        'numeric' => ':attribute có thể không lớn hơn :max.',
        'file'    => ':attribute có thể không lớn hơn :max kilobyte.',
        'string'  => ':attribute có thể không lớn hơn :max ký tự.',
        'array'   => ':attribute có thể không lớn hơn :max khoản mục.',
    ],
    'mimes'                => ':attribute phải là một tệp thuộc loại: :values.',
    'mimetypes'            => ':attribute phải là một tệp thuộc loại: :values.',
    'min'                  => [
        'numeric' => ':attribute phải có ít nhất :min.',
        'file'    => ':attribute phải có ít nhất :min kilobyte.',
        'string'  => ':attribute phải có ít nhất :min ký tự.',
        'array'   => ':attribute phải có ít nhất :min khoản mục.',
    ],
    'not_in'               => 'Lựa chọn :attribute không hợp lệ.',
    'not_regex'            => ':attribute định dạng không hợp lệ.',
    'numeric'              => ':attribute phải là một số.',
    'present'              => ':attribute trường phải tồn tại.',
    'regex'                => ':attribute định dạng không hợp lệ.',
    'required'             => ':attribute trường được yêu cầu.',
    'required_if'          => ':attribute trường được yêu cầu khi :other là :value.',
    'required_unless'      => ':attribute trường được yêu cầu trừ khi :other ở :values.',
    'required_with'        => ':attribute trường được yêu cầu khi :values tồn tại.',
    'required_with_all'    => ':attribute trường được yêu cầu khi :values tồn tại.',
    'required_without'     => ':attribute trường được yêu cầu khi :values không tồn tại.',
    'required_without_all' => ':attribute trường được yêu cầu khi không có :values tồn tại.',
    'same'                 => ':attribute và :other phải khớp.',
    'size'                 => [
        'numeric' => ':attribute phải là :size.',
        'file'    => ':attribute phải là :size kilobyte.',
        'string'  => ':attribute phải là :size ký tự.',
        'array'   => ':attribute phải chứa :size khoản mục.',
    ],
    'string'               => ':attribute phải là một chuỗi.',
    'timezone'             => ':attribute phải là một khu vực hợp lệ.',
    'unique'               => ':attribute đã được thực hiện.',
    'uploaded'             => ':attribute thất bại để tải lên.',
    'url'                  => ':attribute định dạng không hợp lệ.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [],

];
