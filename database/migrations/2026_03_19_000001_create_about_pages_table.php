<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('about_pages', function (Blueprint $table) {
            $table->id();

            // Meta (istersen düzenlenebilir)
            $table->string('meta_title')->nullable();
            $table->string('meta_description', 500)->nullable();
            $table->string('meta_keywords')->nullable();

            // Sayfa başlığı / üst alan
            $table->string('header_h1')->nullable();
            $table->string('about_heading')->nullable();
            $table->string('about_subheading_span')->nullable();
            $table->string('about_subheading_rest')->nullable();
            $table->longText('about_paragraph')->nullable();
            $table->string('about_experience_heading')->nullable();
            $table->string('about_contact_prompt')->nullable();
            $table->string('about_phone_text')->nullable();
            $table->string('about_contact_button_text')->nullable();

            // About görseller
            $table->string('about_img_1')->nullable();
            $table->string('about_circle_icon')->nullable();
            $table->string('about_img_2')->nullable();
            $table->string('about_experience_image')->nullable();
            $table->string('about_icon_experience')->nullable();
            $table->string('about_icon_contact')->nullable();

            // Misyon & Vizyon
            $table->string('mission_vision_image')->nullable();
            $table->string('mission_heading')->nullable();
            $table->longText('mission_text')->nullable();
            $table->string('vision_heading')->nullable();
            $table->longText('vision_text')->nullable();
            $table->string('goal_heading')->nullable();
            $table->longText('goal_text')->nullable();
            $table->string('icon_mission')->nullable();
            $table->string('icon_vision')->nullable();
            $table->string('icon_goal')->nullable();

            // Neden Bizi Tercih Etmelisiniz?
            $table->string('why_choose_heading')->nullable();
            $table->string('why_choose_subheading_span')->nullable();
            $table->string('why_choose_subheading_rest')->nullable();
            $table->string('why_choose_icon_1')->nullable();
            $table->string('why_choose_item_1_title')->nullable();
            $table->longText('why_choose_item_1_text')->nullable();
            $table->string('why_choose_icon_2')->nullable();
            $table->string('why_choose_item_2_title')->nullable();
            $table->longText('why_choose_item_2_text')->nullable();
            $table->string('why_choose_icon_3')->nullable();
            $table->string('why_choose_item_3_title')->nullable();
            $table->longText('why_choose_item_3_text')->nullable();
            $table->string('why_choose_icon_4')->nullable();
            $table->string('why_choose_item_4_title')->nullable();
            $table->longText('why_choose_item_4_text')->nullable();
            $table->string('why_choose_image')->nullable();

            // Taahhüdümüz
            $table->string('commitment_heading')->nullable();
            $table->string('commitment_subheading_span')->nullable();
            $table->string('commitment_subheading_rest')->nullable();
            $table->longText('commitment_paragraph')->nullable();
            $table->string('satisfy_client_text')->nullable();
            $table->string('commitment_counter_item_1')->nullable();
            $table->string('commitment_counter_item_2')->nullable();
            $table->string('commitment_counter_item_3')->nullable();
            $table->string('commitment_list_item_1')->nullable();
            $table->string('commitment_list_item_2')->nullable();
            $table->string('commitment_image_1')->nullable();
            $table->string('satisfy_client_img_1')->nullable();
            $table->string('satisfy_client_img_2')->nullable();
            $table->string('satisfy_client_img_3')->nullable();
            $table->string('satisfy_client_img_4')->nullable();
            $table->string('satisfy_client_img_5')->nullable();
            $table->string('commitment_image_2')->nullable();

            // Uzmanlığımız
            $table->string('expertise_heading')->nullable();
            $table->string('expertise_subheading_span')->nullable();
            $table->string('expertise_subheading_rest')->nullable();
            $table->longText('expertise_paragraph')->nullable();
            $table->string('expertise_icon_1')->nullable();
            $table->string('expertise_item_1_title')->nullable();
            $table->longText('expertise_item_1_text')->nullable();
            $table->string('expertise_icon_2')->nullable();
            $table->string('expertise_item_2_title')->nullable();
            $table->longText('expertise_item_2_text')->nullable();
            $table->string('expertise_counter_label')->nullable();
            $table->string('expertise_counter_list_item_1')->nullable();
            $table->string('expertise_counter_list_item_2')->nullable();
            $table->string('expertise_image')->nullable();
            $table->string('expertise_phone_icon')->nullable();
            $table->string('expertise_contact_heading')->nullable();
            $table->string('expertise_phone_text')->nullable();

            // Ne Yapıyoruz?
            $table->string('what_we_do_heading')->nullable();
            $table->string('what_we_do_subheading_span')->nullable();
            $table->string('what_we_do_subheading_rest')->nullable();
            $table->longText('what_we_do_paragraph_1')->nullable();
            $table->longText('what_we_do_paragraph_2')->nullable();
            $table->string('need_help_icon')->nullable();
            $table->string('need_help_text')->nullable();
            $table->string('what_we_do_phone_text')->nullable();
            $table->string('what_we_counter_icon_1')->nullable();
            $table->string('what_we_counter_label_1')->nullable();
            $table->string('what_we_counter_icon_2')->nullable();
            $table->string('what_we_counter_label_2')->nullable();
            $table->string('what_we_image')->nullable();

            // Uzman Ekibimiz
            $table->string('team_heading')->nullable();
            $table->string('team_subheading_span')->nullable();
            $table->string('team_subheading_rest')->nullable();
            $table->longText('team_paragraph')->nullable();
            $table->string('team_button_text')->nullable();

            $table->string('team_img_1')->nullable();
            $table->string('team_title_1')->nullable();
            $table->string('team_text_1')->nullable();
            $table->string('team_img_2')->nullable();
            $table->string('team_title_2')->nullable();
            $table->string('team_text_2')->nullable();
            $table->string('team_img_3')->nullable();
            $table->string('team_title_3')->nullable();
            $table->string('team_text_3')->nullable();
            $table->string('team_img_4')->nullable();
            $table->string('team_title_4')->nullable();
            $table->string('team_text_4')->nullable();

            // Teknik Destek
            $table->string('support_heading')->nullable();
            $table->string('support_subheading_span')->nullable();
            $table->string('support_subheading_rest')->nullable();
            $table->longText('support_paragraph')->nullable();
            $table->string('support_image_1')->nullable();
            $table->string('support_image_2')->nullable();
            $table->string('support_circle_icon')->nullable();
            $table->string('support_icon_1')->nullable();
            $table->string('support_item_1_title')->nullable();
            $table->longText('support_item_1_text')->nullable();
            $table->string('support_icon_2')->nullable();
            $table->string('support_item_2_title')->nullable();
            $table->longText('support_item_2_text')->nullable();
            $table->string('support_button_text')->nullable();

            // Müşteri Yorumları
            $table->string('testimonials_heading')->nullable();
            $table->string('testimonials_subheading_span')->nullable();
            $table->string('testimonials_subheading_rest')->nullable();
            $table->string('testimonial_quote_icon')->nullable();
            $table->string('testimonial_author_img_1')->nullable();
            $table->string('testimonial_name_1')->nullable();
            $table->string('testimonial_role_1')->nullable();
            $table->longText('testimonial_text_1')->nullable();
            $table->string('testimonial_author_img_2')->nullable();
            $table->string('testimonial_name_2')->nullable();
            $table->string('testimonial_role_2')->nullable();
            $table->longText('testimonial_text_2')->nullable();
            $table->string('testimonial_author_img_3')->nullable();
            $table->string('testimonial_name_3')->nullable();
            $table->string('testimonial_role_3')->nullable();
            $table->longText('testimonial_text_3')->nullable();

            // CTA: İletişim
            $table->string('cta_heading')->nullable();
            $table->string('cta_subheading_span')->nullable();
            $table->string('cta_subheading_rest')->nullable();
            $table->longText('cta_paragraph')->nullable();
            $table->string('cta_phone_icon')->nullable();
            $table->string('cta_phone_label')->nullable();
            $table->string('cta_phone_text')->nullable();
            $table->string('cta_mail_icon')->nullable();
            $table->string('cta_mail_label')->nullable();
            $table->string('cta_mail_text')->nullable();
            $table->string('cta_image')->nullable();

            // Sık Sorulan Sorular
            $table->string('faqs_heading')->nullable();
            $table->string('faqs_subheading_span')->nullable();
            $table->string('faqs_subheading_rest')->nullable();
            $table->longText('faqs_paragraph')->nullable();
            $table->string('faqs_list_item_1')->nullable();
            $table->string('faqs_list_item_2')->nullable();
            $table->string('faqs_list_item_3')->nullable();
            $table->string('faq_image')->nullable();
            $table->string('faq_q_1')->nullable();
            $table->longText('faq_a_1')->nullable();
            $table->string('faq_q_2')->nullable();
            $table->longText('faq_a_2')->nullable();
            $table->string('faq_q_3')->nullable();
            $table->longText('faq_a_3')->nullable();
            $table->string('faq_q_4')->nullable();
            $table->longText('faq_a_4')->nullable();

            $table->boolean('is_active')->default(true);
            $table->unsignedSmallInteger('sort_order')->default(0);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('about_pages');
    }
};

