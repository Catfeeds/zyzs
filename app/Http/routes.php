<?php
Route::group(['middleware' => ['web','admin']], function () {
    Route::get('/manage/main', 'ManageController@index');
    //导航

    Route::get('/manage/friendlinks','ManageController@friendlinks');
    Route::get('/manage/friendlinks/create','ManageController@friendlinkscreate');
    Route::post('/manage/friendlinks','ManageController@friendliknsstore');
    Route::get('/manage/friendlinks/remove/{id}','ManageController@friendlinksdelete');

    Route::get('/manage/indexline','ManageController@indexline');
    Route::get('/manage/indexline/create','ManageController@indexlinecreate');
    Route::post('/manage/indexline','ManageController@indexlinestore');
    Route::get('/manage/indexline/remove/{id}','ManageController@indexlinedelete');

    Route::get('/manage/bottomurl','ManageController@bottomurl');
    Route::get('/manage/bottomurl/create','ManageController@bottomurlcreate');
    Route::post('manage/bottomurl','ManageController@bottomurlstore');
    Route::get('/manage/bottomurl/remove/{id}','ManageController@bottomurldelete');
    

    Route::get('/manage/fengge','ManageController@fengge');
    Route::get('/manage/fengge/create','ManageController@fenggecreate');
    Route::post('/manage/fengge','ManageController@fenggestore');
    Route::post('/manage/fengge/create','ManageController@fenggecreatestore');
    Route::get('/manage/fengge/{id}/delete','ManageController@fenggedelete');

    Route::get('/manage/indexcase','ManageController@indexcase');
    Route::post('/manage/indexcase','ManageController@indexcasestore');
    Route::get('/manage/indexcase/select',"ManageController@indexcaseselect");
    Route::post('/manage/indexcase/select',"ManageController@indexcaseselectstore");
    Route::get('/manage/indexcase/{id}/delete','ManageController@indexcasedelete');


    Route::get('/manage/sitenav/jobs/{id}','ManageController@recruit');
    Route::get('/manage/job/insert/{id}','ManageController@recruitinsert');
    Route::post('/manage/job/insert/{id}','ManageController@recruitinsertstore');

    Route::get('/manage/job/update/{id}','ManageController@recruitedit');
    Route::post('/manage/job/update/{id}','ManageController@recruiteditpost');
    Route::get('/manage/job/remove/{id}','ManageController@recruitdelete');
    Route::post('/manage/sitenav/jobs/{id}',"ManageController@recruitstore");

    Route::get("/manage/course",'ManageController@course');
    Route::post("/manage/course",'ManageController@coursestore');

    Route::get('/manage/course3','ManageController@course3');
    Route::post('/manage/course3','ManageController@course3store');
    Route::get('/manage/course3/create','ManageController@course3create');
    Route::get('/manage/course3/{id}/delete','ManageController@course3delete');


    Route::get('/manage/sitenav','ManageController@sitenav');
	Route::post('/manage/sitenav','ManageController@sitenavstore');
	Route::post('/manage/checkstyle','ManageController@checkstyle');
	//导航的侧边栏编辑
	Route::get('/manage/sitenav/{id}/section','ManageController@sitenav_section');

	Route::get('/manage/three','ManageController@three');
	Route::post('/manage/three','ManageController@threestore');
	Route::get('/manage/three/{id}/edit','ManageController@threeedit');
	Route::post('/manage/three/{id}/edit','ManageController@threeeditstore');
	Route::get('/manage/three/{id}/delete','ManageController@threeeditdelete');


	Route::get('/manage/three/create','ManageController@threecreate');


	Route::get('/manage/indeximg','ManageController@indeximg');
	Route::get('/manage/indeximg/create','ManageController@indeximgcreate');
	Route::get('/manage/indeximg/remove/{id}','ManageController@indeximgremove');
	Route::post('/manage/indeximg','ManageController@indeximgstore');


	//侧边栏管理
	Route::get('/manage/sitenav/sections','ManageController@sections');
	Route::post('/manage/sitenav/sections','ManageController@sectionsstore');
	Route::get('/manage/sitenav/sections/add','ManageController@sectionsadd');
	Route::get('/manage/sitenav/sections/{id}/delete',"ManageController@sectiondelete");
	//管理该侧边栏的板块们
	Route::get('/manage/sitenav/sections/{id}','ManageController@sections_bk');
	Route::post('/manage/sitenav/sections/{id}','ManageController@sections_bk_store');
	Route::get('/manage/sitenav/sections/caseSection/getcases/{page}','ManageController@getcases');
	//删除案例侧边栏的案例
	Route::get('/manage/sitenav/sections/caseSection/{id}/case/{caseid}','ManageController@casesectioncasedelete');
	Route::get('/manage/sitenav/sections/caseSection/{id}/case/{caseid}/add','ManageController@casesectioncaseadd');

	//删除版块
	Route::get('/manage/sitenav/sections/articleSection/{id}/delete','ManageController@articleSectionDelete');
	//增加文章版块
	Route::get('/manage/sitenav/sections/{id}/articleSection/add','ManageController@articlesectionAdd');
	//增加案例版块
	Route::get('/manage/sitenav/sections/{id}/caseSection/add','ManageController@casesectionAdd');

	Route::get('/manage/sitenav/sections/caseSection/{id}/delete','ManageController@casesectiondelete');
	Route::get('/manage/sitenav/sections/caseSection/list/{id}','ManageController@casesectionmanager');

	//选择新边侧栏
	Route::get('/manage/sitenav/{navid}/section/{sectionid}','ManageController@sitenav_section_select');
	//删除侧边栏
	Route::get('/manage/sitenav/insert','ManageController@sitenavinsert');
	Route::post('/manage/sitenav/insert','ManageController@sitenavinserts');
	Route::get('/manage/sitenav/edit/{sitenav_id}','ManageController@sitenavedit');
	Route::post('/manage/sitenav/edit/{sitenav_id}','ManageController@sitenavedits');
	Route::get('/manage/sitenav/delete/{sitenav_id}','ManageController@sitenavdelete');
	//子菜单
	Route::get('/manage/sitenav/sub/insert/{sitenav_id}','ManageController@sitenavsubinsert');
	Route::post('/manage/sitenav/sub/insert/{sitenav_id}','ManageController@sitenavsubinserts');
	Route::get('/manage/sitenav/sub/edit/{sitenav_id}','ManageController@sitenavsubedit');
	Route::post('/manage/sitenav/sub/edit/{sitenav_id}','ManageController@sitenavsubedits');

	//团队管理
	Route::get('/manage/yuyue','ManageController@yuyue');
	Route::get('/manage/yuyue/{id}/delete',"ManageController@yuyuedelete");
	Route::get('/manage/yuyue/{id}/yidu','ManageController@yuyueyidu');

	Route::post('/manage/memberremovemany','ManageController@memberremovemany');
	//预约管理

	
	Route::get('/manage/teams/member/{id}/delete','ManageController@memeber_delete');
	Route::get('/manage/teams/member/{id}/edit','ManageController@member_edit');
	Route::post('/manage/teams/member/{id}/edit','ManageController@member_edit_post');

	Route::get('/manage/indexeight','ManageController@indexeight');
	Route::post('/manage/indexeight','ManageController@indexeightstrore');
	Route::get('/manage/indexeight/create','ManageController@indexeightcreate');
	Route::get('/manage/indexeight/remove/{id}','ManageController@indexeightdelete');


	//相册管理
	Route::get('/manage/albums/{navid}','ManageController@albums');
	Route::post('/manage/albums/{navid}','ManageController@albumspost');

	// 添加图片
	Route::get('/manage/albumpic/insert/{albumid}','ManageController@albumpicadd');


	Route::get('/manage/teams/add/{nav_id}','ManageController@teams_add');
	Route::get('/manage/teams/{teamid}/delete','ManageController@teams_delete');
	Route::get('/manage/teams/{teamid}/edit','ManageController@teams_edit');
	Route::post('/manage/teams/{teamid}/edit','ManageController@teams_edit_post');

	Route::get('/manage/teams/{teamid}/create','ManageController@team_create');
	Route::get('/manage/teams/{id}','ManageController@teams');


	Route::get('/manage/case/{id}',"ManageController@cases");
	Route::post('/manage/case/{id}',"ManageController@casesstore");
	Route::get('/manage/case/{id}/edit',"ManageController@caseedit");
	Route::post('/manage/case/{id}/edit',"ManageController@caseeditstore");
	Route::post('/manage/sitenav/casebatchmove',"ManageController@casebatchmove");
	Route::post('/manage/sitenav/casebatchmove/store',"ManageController@casebatchmovestore");

	Route::get('/manage/case/{id}/insert','ManageController@caseinsert');
	Route::post('/manage/case/{id}/insert','ManageController@caseinsertstore');
	Route::get('/manage/case/{id}/delete','ManageController@casedelete');


	//其他类型
	Route::get('/manage/sitenav/article/{sitenav_id}','ManageController@sitenavarticle');
	Route::post('/manage/sitenav/article/{sitenav_id}','ManageController@sitenavarticleupdate');
	Route::post('/manage/sitenav/articlebatchmove','ManageController@articlebatchmove');
	Route::post('/manage/sitenav/articlebatchmove/store','ManageController@articlebatchmovestore');
	Route::post('/manage/sitenav/articlebatchremove','ManageController@articlebatchremove');
	Route::post('/manage/sitenav/articlebatchremove/store','ManageController@articlebatchremovestore');
	Route::get('/manage/article/update/{sitenav_id}','ManageController@articleupdate');
	Route::post('/manage/article/update/{sitenav_id}','ManageController@articleupdatestore');
	Route::get('/manage/article/remove/{sitenav_id}','ManageController@articleremove');
	Route::get('/manage/article/insert/{sitenav_id}','ManageController@articleinsert');
	Route::post('/manage/aritcle/insert/{sitenav_id}','ManageController@articleinsertstore');
	//product
	Route::get('/manage/product/insert/{sitenav_id}','ManageController@productinsert');
	Route::post('/manage/product/insert/{sitenav_id}','ManageController@productinsertstore');
	Route::get('/manage/product/update/{sitenav_id}','ManageController@productupdate');
	Route::post('/manage/product/update/{sitenav_id}','ManageController@productupdatestore');
	Route::get('/manage/sitenav/products/{sitenav_id}','ManageController@productlists');
	Route::post('/manage/sitenav/products/{sitenav_id}','ManageController@productlistsupdate');
	Route::get('/manage/product/remove/{sitenav_id}','ManageController@productremove');
	Route::post('/manage/sitenav/productbatchremove','ManageController@productbatchremove');
	
	//album
	Route::get('/manage/album/insert/{sitenav_id}','ManageController@albuminsert');
	Route::post('/manage/album/insert/{sitenav_id}','ManageController@albuminsertstore');
	Route::get('/manage/album/update/{sitenav_id}','ManageController@albumupdate');
	Route::post('/manage/album/update/{sitenav_id}','ManageController@albumupdatestore');
	Route::get('/manage/sitenav/albums/{sitenav_id}','ManageController@albumlists');
	Route::post('/manage/sitenav/albums/{sitenav_id}','ManageController@albumlistsupdate');
	Route::get('/manage/album/remove/{sitenav_id}','ManageController@albumremove');
	Route::get('/manage/pubajax/photosinsert/','PubapiController@photos');
	Route::post('/manage/pubajax/photosinsert/','PubapiController@photosinsert');
	Route::post('/manage/sitenav/albumbatchremove','ManageController@albumbatchremove');
	//job
	// Route::get('/manage/job/insert/{sitenav_id}','ManageController@jobinsert');
	// Route::post('/manage/job/insert/{sitenav_id}','ManageController@jobinsertstore');
	// Route::get('/manage/job/update/{sitenav_id}','ManageController@jobupdate');
	// Route::post('/manage/job/update/{sitenav_id}','ManageController@jobupdatestore');
	// Route::get('/manage/sitenav/jobs/{sitenav_id}','ManageController@joblists');
	// Route::post('/manage/sitenav/jobs/{sitenav_id}','ManageController@joblistsupdate');
	// Route::get('/manage/job/remove/{sitenav_id}','ManageController@jobremove');
	// Route::post('/manage/sitenav/jobbatchremove','ManageController@jobbatchremove');
	//feedback
	Route::get('/manage/feedback/list','ManageController@feedbacklist');
	Route::get('/manage/feedback/view/{feedback_id}','ManageController@feedbackview');
	Route::post('/manage/feedback/view/{feedback_id}','ManageController@feedbackreply');
	Route::get('/manage/feedback/ts/{feedback_id}','ManageController@feedbacktslist');
	Route::post('/manage/feedback/ts/{feedback_id}','ManageController@feedbacktsstore');
	Route::get('/manage/feedback/remove/{feedback_id}','ManageController@feedbackremove');
	Route::post('/manage/feedback/batchremove','ManageController@feedbackbatchremove');
	Route::get('/manage/feedback/menu','ManageController@feedbackmenu');
	Route::post('/manage/feedback/menu','ManageController@feedbackmenustore');
	Route::get('/manage/feedback/menu/insert','ManageController@feedbackmenuinsert');
	Route::post('/manage/feedback/menu/insert','ManageController@feedbackmenuinsertstore');
	Route::get('/manage/feedback/menu/remove/{feedbacktype_id}','ManageController@feedbackmenuremove');
	Route::post('/manage/feedback/menu/batchremove','ManageController@feedbackmenubatchremove');

	Route::get('/manage/common/list/{common_id}','ManageController@commonlist');
	Route::post('/manage/common/list/{common_id}','ManageController@commonlistupdate');
	Route::get('/manage/common/list','ManageController@commonlist');
	Route::post('/manage/common/list','ManageController@commonlistupdate');
	Route::get('/manage/common/remove/{common_id}','ManageController@commonremove');
	Route::post('/manage/common/batchremove','ManageController@commonbatchremove');
	Route::get('/manage/common/edit/{common_id}','ManageController@commonedit');
	Route::post('/manage/common/edit/{common_id}','ManageController@commoneditstore');
	Route::get('/manage/common/insert','ManageController@commoninsert');
	Route::post('/manage/common/insert','ManageController@commoninsertstore');
	Route::get('/manage/common/menu','ManageController@commonmenu');
	Route::post('/manage/common/menu','ManageController@commonmenustore');
	Route::get('/manage/common/menu/insert','ManageController@commonmenuinsert');
	Route::post('/manage/common/menu/insert','ManageController@commonmenuinsertstore');
	Route::get('/manage/common/menu/remove/{common_id}','ManageController@commonmenuremove');
	Route::post('/manage/common/menu/batchremove','ManageController@commonmenubatchremove');

	//set
	Route::get('/manage/footer','ManageController@footerlist');
	Route::post('/manage/footer','ManageController@footerliststore');

	Route::get('/manage/siteset','ManageController@siteset');
	Route::post('/manage/siteset','ManageController@sitesetstore');

	Route::get('/manage/banner','ManageController@indexbanner');
	Route::post('/manage/banner','ManageController@indexbannerstore');
	Route::get('/manage/banner/insert','ManageController@indexbannerinsert');
	Route::post('/manage/banner/insert','ManageController@indexbannerinsertstore');
	Route::get('/manage/banner/insert','ManageController@indexbannerinsert');
	Route::get('/manage/banner/remove/{banner_id}','ManageController@indexbannerremove');
	Route::post('/manage/bannerbatchremove','ManageController@indexbannerbatchremove');

	//导航回收站
	Route::get('/manage/sitenav/deleted','ManageController@sitenavdeleted');
	Route::get('/manage/sitenav/clear','ManageController@sitenavclear');
	Route::get('/manage/sitenav/rcover/{sitenav_id}','ManageController@sitenavrecover');

	//其他
	Route::get('/manage/change/password','ManageController@password');
	Route::post('/manage/change/password','ManageController@passwordstore');
	
});

Route::group(['middleware' => ['web','servers']], function () {
	Route::get('/online/server/reception','OnlineserverController@receptions');
	Route::post('/server/chat/server/online','OnlineserverController@online');
	Route::post('/server/chat/server/getcustomers','OnlineserverController@getcustomers');
	Route::get('/online/server/reception/{customerid}','OnlineserverController@reception');
	Route::post('/server/chat/server/history','OnlineserverController@history');
	Route::post('/server/chat/server/sentmessage','OnlineserverController@sentmessage');
	Route::post('/server/chat/server/getmsg','OnlineserverController@getmsg');
	Route::post('/server/chat/server/uploadfile','OnlineserverController@uploadfile');
	Route::post('/server/chat/server/cancelnotice','OnlineserverController@cancelnotice');
    Route::get('/server/logout','OnlineserverController@logout');
});



Route::group(['middleware' => ['web']], function () {
    Route::auth();
    Route::post('/change/location/customer','SiteController@changelocation');
    Route::post('/get/location/customer','SiteController@getlocation');
    Route::get('/test','HomeController@index');


    Route::get('/', 'SiteController@index');

    Route::post('/search','SiteController@search');

    Route::post('/yuyue','SiteController@yuyue');

    //Route::get('/','FrontController@index');

    Route::get('/captcha', 'OnlineserverController@captcha');
    Route::get('/notice','SiteController@notice');
    // Route::get('/support','SiteController@support');
    // Route::get('/support/dealers','SiteController@dealers');
    // Route::get('/support/common','SiteController@common');
    // Route::get('/support/common/{common_id}','SiteController@common');
    // Route::get('/support/common/view/{common_id}','SiteController@commonview');
    // Route::get('/support/feedback','SiteController@feedback');
    Route::get('/feedback','SiteController@feedbacklist');
    Route::get('/feedback/sent','SiteController@feedback');
    Route::post('/feedback/team/sent','SiteController@feedbackteamstore');
    Route::post('/feedback/sent','SiteController@feedbackstore');
    Route::get('/feedback/my/{id}','SiteController@feedbackmy');

    // Route::post('/support/feedback','SiteController@feedbackreceive');
    // Route::get('/contactus','SiteController@contactus');

    Route::post('/search','SiteController@search');
    Route::post('/pubajax/praise/{article_id}','PubapiController@praiseapi');
    Route::post('/pubajax/common/{feedback_id}','PubapiController@commonapi');

    //Route::get('/article-view-{id}.html','ArticlesController@article_show');
    //Route::get('/products-view-{id}.html','ProductsController@show');
    //Route::get('/albums-view-{id}.html','AlbumsController@show');

    Route::get('/api/articles/{nav_id}','SiteController@articles_page');
    Route::get('/api/articles/{articleid}/zan','SiteController@dianzan');
    Route::get('/article-view-{id}.html','SiteController@article');
    Route::get('/album-view-{id}.html','SiteController@album');
    Route::get('/team-view-{id}.html','SiteController@team');
    Route::get('/case-view-{id}.html','SiteController@caseview');
    Route::get('/style-view-{id}.html','SiteController@casestyleviews');
    Route::get('/recruit-view-{id}.html','SiteController@recruit');
    Route::get('/server/chat','OnlinecustomerController@init');
    Route::get('/appointment/sent','SiteController@appointmentsent');
    Route::post('/appointment/make','SiteController@yuyue');
    Route::post('/appointment/sent/fast','SiteController@yuyuefast');
    
    Route::post('/server/chat/history','OnlinecustomerController@history');
    Route::post('/server/chat/chooseserver','OnlinecustomerController@chooseserver');
    Route::post('/server/chat/sentmessage','OnlinecustomerController@sentmessage');
    Route::post('/server/chat/getmsg','OnlinecustomerController@getmsg');
    Route::post('/server/chat/uploadfile','OnlinecustomerController@uploadfile');
    Route::post('/server/chat/online','OnlinecustomerController@online');
    Route::get('/server/login','OnlineserverController@login');
    Route::post('/server/login','OnlineserverController@loginstore');
    Route::get('/{nickname}/{subname}','SiteController@sub');
    Route::get('/{nickname}/{subname}/{style}','SiteController@sub');
	Route::get('/{nickname}','SiteController@sub');
	
});