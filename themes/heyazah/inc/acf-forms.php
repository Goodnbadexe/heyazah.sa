<?php
/**
 * ACF Local Fields & CF7 Dynamic Labels - SIMPLIFIED VERSION
 * This version uses a more reliable approach
 */

// ============================================
// 1. REGISTER ACF FIELDS
// ============================================

if (function_exists('acf_add_local_field_group')):

acf_add_local_field_group(array(
    'key' => 'group_service_form_labels',
    'title' => 'إعدادات نموذج المساعدة (التسميات فقط)',
    'fields' => array(
        
        // Instructions
        array(
            'key' => 'field_instructions',
            'label' => 'تعليمات',
            'name' => 'form_instructions',
            'type' => 'message',
            'message' => '<div style="background:#e7f5fe;padding:15px;border-right:4px solid #2271b1;"><strong>ملاحظة هامة:</strong><br>يمكنك تعديل النصوص والتسميات فقط. التعديلات ستظهر مباشرة في النموذج.</div>',
        ),

        // Step 1
        array(
            'key' => 'field_step1_tab',
            'label' => 'الخطوة 1: المقدمة',
            'type' => 'tab',
        ),
        array(
            'key' => 'field_step1_title',
            'label' => 'عنوان الخطوة الأولى',
            'name' => 'step1_title',
            'type' => 'text',
            'default_value' => 'الشروط والأحكام',
        ),
        array(
            'key' => 'field_step1_content',
            'label' => 'محتوى الخطوة الأولى',
            'name' => 'step1_content',
            'type' => 'textarea',
            'default_value' => 'مرحباً بك في خدمة مساعدة المقبلين على الزواج',
        ),

        // Step 2 - Husband
        array(
            'key' => 'field_step2_tab',
            'label' => 'الخطوة 2: بيانات الزوج',
            'type' => 'tab',
        ),
        array(
            'key' => 'field_step2_heading',
            'label' => 'عنوان القسم',
            'name' => 'step2_heading',
            'type' => 'text',
            'default_value' => 'بيانات الزوج',
        ),
        array(
            'key' => 'field_husband_name_label',
            'label' => 'تسمية: اسم الزوج',
            'name' => 'husband_name_label',
            'type' => 'text',
            'default_value' => 'اسم الزوج بالكامل',
        ),
        array(
            'key' => 'field_husband_name_placeholder',
            'label' => 'نص توضيحي',
            'name' => 'husband_name_placeholder',
            'type' => 'text',
            'default_value' => 'أدخل الاسم الكامل',
        ),
        array(
            'key' => 'field_husband_id_label',
            'label' => 'تسمية: رقم الهوية',
            'name' => 'husband_id_label',
            'type' => 'text',
            'default_value' => 'رقم الهوية الوطنية',
        ),
        array(
            'key' => 'field_husband_phone_label',
            'label' => 'تسمية: رقم الجوال',
            'name' => 'husband_phone_label',
            'type' => 'text',
            'default_value' => 'رقم الجوال',
        ),
        array(
            'key' => 'field_husband_relative_phone_label',
            'name' => 'husband_relative_phone_label',
            'type' => 'text',
            'default_value' => 'رقم جوال أحد الأقارب',
        ),
        array(
            'key' => 'field_husband_address_label',
            'name' => 'husband_address_label',
            'type' => 'text',
            'default_value' => 'العنوان بالتفصيل',
        ),
        array(
            'key' => 'field_husband_age_label',
            'name' => 'husband_age_label',
            'type' => 'text',
            'default_value' => 'العمر',
        ),
        array(
            'key' => 'field_husband_qualification_label',
            'name' => 'husband_qualification_label',
            'type' => 'text',
            'default_value' => 'المؤهل العلمي',
        ),
        array(
            'key' => 'field_husband_job_label',
            'name' => 'husband_job_label',
            'type' => 'text',
            'default_value' => 'الوظيفة الحالية',
        ),
        array(
            'key' => 'field_husband_salary_label',
            'name' => 'husband_salary_label',
            'type' => 'text',
            'default_value' => 'الراتب الشهري',
        ),
        array(
            'key' => 'field_husband_parents_alive_label',
            'name' => 'husband_parents_alive_label',
            'type' => 'text',
            'default_value' => 'هل والديك على قيد الحياة؟',
        ),
        array(
            'key' => 'field_husband_health_status_label',
            'name' => 'husband_health_status_label',
            'type' => 'text',
            'default_value' => 'الحالة الصحية',
        ),
        array(
            'key' => 'field_husband_debt_label',
            'name' => 'husband_debt_label',
            'type' => 'text',
            'default_value' => 'هل لديك ديون؟',
        ),
        array(
            'key' => 'field_husband_debt_amount_label',
            'name' => 'husband_debt_amount_label',
            'type' => 'text',
            'default_value' => 'مقدار الديون',
        ),
        array(
            'key' => 'field_husband_house_type_label',
            'name' => 'husband_house_type_label',
            'type' => 'text',
            'default_value' => 'نوع السكن',
        ),
        array(
            'key' => 'field_husband_rent_value_label',
            'name' => 'husband_rent_value_label',
            'type' => 'text',
            'default_value' => 'قيمة الإيجار',
        ),

        // Step 3 - Wife
        array(
            'key' => 'field_step3_tab',
            'label' => 'الخطوة 3: بيانات الزوجة',
            'type' => 'tab',
        ),
        array(
            'key' => 'field_step3_heading',
            'name' => 'step3_heading',
            'type' => 'text',
            'default_value' => 'بيانات الزوجة',
        ),
        array(
            'key' => 'field_wife_name_label',
            'name' => 'wife_name_label',
            'type' => 'text',
            'default_value' => 'اسم الزوجة بالكامل',
        ),
        array(
            'key' => 'field_wife_phone_label',
            'name' => 'wife_phone_label',
            'type' => 'text',
            'default_value' => 'رقم الجوال',
        ),
        array(
            'key' => 'field_wife_id_label',
            'name' => 'wife_id_label',
            'type' => 'text',
            'default_value' => 'رقم الهوية الوطنية',
        ),
        array(
            'key' => 'field_wife_age_label',
            'name' => 'wife_age_label',
            'type' => 'text',
            'default_value' => 'العمر',
        ),
        array(
            'key' => 'field_wife_qualification_label',
            'name' => 'wife_qualification_label',
            'type' => 'text',
            'default_value' => 'المؤهل العلمي',
        ),
        array(
            'key' => 'field_wife_marriage_date_label',
            'name' => 'wife_marriage_date_label',
            'type' => 'text',
            'default_value' => 'تاريخ الزواج',
        ),
        array(
            'key' => 'field_wife_mahr_label',
            'name' => 'wife_mahr_label',
            'type' => 'text',
            'default_value' => 'مبلغ المهر',
        ),
        array(
            'key' => 'field_wife_mahr_remaining_label',
            'name' => 'wife_mahr_remaining_label',
            'type' => 'text',
            'default_value' => 'المتبقي من المهر',
        ),

        // Step 4 - Upload
        array(
            'key' => 'field_step4_tab',
            'label' => 'الخطوة 4: المرفقات',
            'type' => 'tab',
        ),
        array(
            'key' => 'field_upload_files_label',
            'name' => 'upload_files_label',
            'type' => 'text',
            'default_value' => 'إرفاق المستندات المطلوبة',
        ),
        array(
            'key' => 'field_upload_files_description',
            'name' => 'upload_files_description',
            'type' => 'textarea',
            'default_value' => 'يرجى إرفاق صورة الهوية الوطنية',
        ),

        // Step 5 - Confirmation
        array(
            'key' => 'field_step5_tab',
            'label' => 'الخطوة 5: التأكيد',
            'type' => 'tab',
        ),
        array(
            'key' => 'field_confirmation_label',
            'name' => 'confirmation_label',
            'type' => 'text',
            'default_value' => 'أوافق على الشروط والأحكام',
        ),

        // Navigation
        array(
            'key' => 'field_navigation_tab',
            'label' => 'أزرار التنقل',
            'type' => 'tab',
        ),
        array(
            'key' => 'field_next_button_text',
            'name' => 'next_button_text',
            'type' => 'text',
            'default_value' => 'التالي',
        ),
        array(
            'key' => 'field_previous_button_text',
            'name' => 'previous_button_text',
            'type' => 'text',
            'default_value' => 'السابق',
        ),
        array(
            'key' => 'field_submit_button_text',
            'name' => 'submit_button_text',
            'type' => 'text',
            'default_value' => 'إرسال الطلب',
        ),

        // Template Settings
        array(
            'key' => 'field_template_tab',
            'label' => 'إعدادات الصفحة',
            'type' => 'tab',
        ),
        array(
            'key' => 'field_steps_sidebar_title',
            'name' => 'steps_sidebar_title',
            'type' => 'text',
            'default_value' => 'خطوات المساعدة',
        ),

    ),
    'location' => array(
        array(
            array(
                'param' => 'post_type',
                'operator' => '==',
                'value' => 'service',
            ),
            array(
                'param' => 'post_template',
                'operator' => '==',
                'value' => 'service-template/married.php',
            ),
        ),
    ),
));

endif;

// ============================================
// 2. REPLACE SHORTCODES IN CF7 FORM
// ============================================

add_filter('wpcf7_form_elements', 'replace_acf_in_cf7_form', 999);

function replace_acf_in_cf7_form($form_html) {
    // Only run on service post type
    if (!is_singular('service')) {
        return $form_html;
    }
    
    $post_id = get_the_ID();
    if (!$post_id) {
        return $form_html;
    }
    
    // Find all [CF7_get_custom_field key="xxx"] patterns
    $pattern = '/\[CF7_get_custom_field\s+key=["\']([^"\']+)["\']\s*\]/i';
    
    $form_html = preg_replace_callback($pattern, function($matches) use ($post_id) {
        $field_key = $matches[1];
        
        // Get ACF value
        $value = get_field($field_key, $post_id);
        
        // If empty, get default value
        if (empty($value)) {
            $field_object = get_field_object($field_key, $post_id);
            if ($field_object && isset($field_object['default_value'])) {
                $value = $field_object['default_value'];
            }
        }
        
        // Handle arrays (shouldn't happen but just in case)
        if (is_array($value)) {
            $value = implode(' | ', $value);
        }
        
        // Return sanitized value
        return esc_html($value);
        
    }, $form_html);
    
    return $form_html;
}

// ============================================
// 3. SECURITY: HIDE CF7 FROM NON-ADMINS
// ============================================

// Remove CF7 capabilities from editors
add_action('admin_init', function() {
    $editor = get_role('editor');
    if ($editor) {
        $editor->remove_cap('wpcf7_edit_contact_forms');
        $editor->remove_cap('wpcf7_read_contact_forms');
        $editor->remove_cap('wpcf7_delete_contact_forms');
    }
});

// Hide CF7 menu from non-admins
add_action('admin_menu', function() {
    if (!current_user_can('manage_options')) {
        remove_menu_page('wpcf7');
    }
}, 999);

// ============================================
// 4. HELPER FUNCTION FOR TEMPLATES
// ============================================

function get_form_label($field_name, $default = '') {
    if (!is_singular('service')) {
        return $default;
    }
    
    $value = get_field($field_name);
    return $value ? $value : $default;
}