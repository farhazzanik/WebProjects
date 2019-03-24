SELECT news_info.id,news_info.title, news_info.fb_share_text, news_info.ext,news_main_menu.main_menu_id FROM `news_info` INNER JOIN `news_main_menu` ON news_info.id=news_main_menu.news_id WHERE news_main_menu.main_menu_id='11003' ORDER BY news_main_menu.news_id DESC LIMIT 3

fot main menu select


SELECT news_info.id,news_info.title, news_info.fb_share_text, news_info.ext,news_sub_menu.main_menu_id,news_sub_menu.sub_menu_id FROM `news_info` INNER JOIN `news_sub_menu` ON news_info.id=news_sub_menu.news_id WHERE news_sub_menu.main_menu_id='11012' AND news_sub_menu.sub_menu_id='12040'  ORDER BY news_sub_menu.news_id DESC LIMIT 3

  <div class="row-fluid">
                    <ol class="breadcrumb font16">
                <div class='nav_menu'><a href='../home'>???</a> &raquo; <span class='b'></span><a href='politics.html'>???????</a> &raquo; </div>            </ol>
            </div>
</div>