-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- 主机： localhost
-- 生成日期： 2023-12-11 16:26:37
-- 服务器版本： 5.7.43-log
-- PHP 版本： 7.2.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 数据库： `wvickx`
--

-- --------------------------------------------------------

--
-- 表的结构 `dy_admin_group`
--

CREATE TABLE `dy_admin_group` (
  `gid` smallint(5) UNSIGNED NOT NULL,
  `name` char(20) NOT NULL,
  `audit` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `paction` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `dy_admin_group`
--

INSERT INTO `dy_admin_group` (`gid`, `name`, `audit`, `paction`) VALUES
(1, '录入员', 0, ',a_html,a_article,a_article_add,a_article_edit,a_article_del,a_article_audit,a_product,a_product_add,a_product_edit,a_product_del,a_product_audit,a_message,a_message_edit,a_message_del,a_message_audit,a_article_index,a_classtypes_index,a_fields_info,a_adminuser_edituser,uploads,a_label,a_sys_ecache,a_product_index,');

-- --------------------------------------------------------

--
-- 表的结构 `dy_admin_per`
--

CREATE TABLE `dy_admin_per` (
  `pid` tinyint(5) UNSIGNED NOT NULL,
  `action` char(50) NOT NULL,
  `name` char(20) NOT NULL,
  `up` tinyint(5) NOT NULL DEFAULT '0',
  `no` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `orders` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `molds` char(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `dy_admin_per`
--

INSERT INTO `dy_admin_per` (`pid`, `action`, `name`, `up`, `no`, `orders`, `molds`) VALUES
(1, 'a_article', '管理', 0, 0, 20, 'article'),
(2, 'a_classtypes', '栏目管理', 0, 0, 96, ''),
(3, 'a_fields', '自定义字段管理', 37, 0, 29, ''),
(4, 'a_article_index', '列表', 1, 1, 0, ''),
(5, 'a_article_add', '添加', 1, 0, 0, ''),
(6, 'a_article_edit', '编辑', 1, 0, 0, ''),
(7, 'a_article_del', '删除', 1, 0, 0, ''),
(8, 'a_article_audit', '审核', 1, 0, 0, ''),
(9, 'a_classtypes_index', '栏目列表', 2, 1, 0, ''),
(10, 'a_classtypes_add', '栏目添加', 2, 0, 0, ''),
(11, 'a_classtypes_edit', '栏目编辑', 2, 0, 0, ''),
(12, 'a_classtypes_del', '栏目删除', 2, 0, 0, ''),
(13, 'a_molds', '频道设置', 37, 0, 30, ''),
(17, 'a_adminuser', '管理员管理', 36, 0, 29, ''),
(22, 'a_sys', '系统设置', 36, 0, 30, ''),
(24, 'a_fields_info', '字段列表', 0, 1, 0, ''),
(27, 'a_adminuser_edituser', '修改资料', 0, 1, 0, ''),
(28, 'uploads', '上传', 0, 1, 0, ''),
(29, 'a_traits', '推荐属性管理', 37, 0, 28, ''),
(34, 'a_dbbak', '数据备份', 36, 0, 27, ''),
(35, 'a_label', '模板调用生成器', 0, 1, 0, ''),
(36, '', '系统', 0, 0, 99, ''),
(37, '', '频道管理', 0, 0, 97, ''),
(38, 'a_sys_ecache', '更新缓存', 0, 1, 0, ''),
(40, 'a_labelcus', '自定义模板标签', 36, 0, 28, ''),
(41, 'a_funs', '插件设置', 42, 0, 30, ''),
(42, '', '插件管理', 0, 0, 98, ''),
(43, 'a_files', '清理附件', 36, 0, 0, ''),
(66, 'a_message', '管理', 0, 0, 0, 'message'),
(67, 'a_message_edit', '编辑', 66, 0, 0, ''),
(68, 'a_message_del', '删除', 66, 0, 0, ''),
(69, 'a_message_audit', '审核', 66, 0, 0, ''),
(71, 'a_comment', '评论管理', 42, 0, 0, ''),
(72, 'a_links', '友情链接管理', 42, 0, 0, ''),
(73, 'a_member', '会员管理', 42, 0, 0, ''),
(74, 'a_special', '专题管理', 42, 0, 0, ''),
(75, 'a_update', '在线升级', 36, 0, 0, ''),
(76, 'a_html', '静态生成', 36, 0, 0, ''),
(77, 'a_product', '管理', 0, 0, 20, 'product'),
(78, 'a_product_index', '列表', 77, 1, 0, ''),
(79, 'a_product_add', '添加', 77, 0, 0, ''),
(80, 'a_product_edit', '编辑', 77, 0, 0, ''),
(81, 'a_product_del', '删除', 77, 0, 0, ''),
(82, 'a_product_audit', '审核', 77, 0, 0, ''),
(84, 'a_ads', '广告管理', 42, 0, 0, '');

-- --------------------------------------------------------

--
-- 表的结构 `dy_admin_user`
--

CREATE TABLE `dy_admin_user` (
  `auid` smallint(5) UNSIGNED NOT NULL,
  `auser` char(20) NOT NULL,
  `apass` char(32) NOT NULL,
  `aname` char(30) NOT NULL,
  `amail` char(100) NOT NULL,
  `atel` char(100) NOT NULL,
  `level` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `gid` smallint(5) UNSIGNED NOT NULL DEFAULT '0',
  `pclasstype` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `dy_admin_user`
--

INSERT INTO `dy_admin_user` (`auid`, `auser`, `apass`, `aname`, `amail`, `atel`, `level`, `gid`, `pclasstype`) VALUES
(1, 'admin', '68191ca69563243b0c1dc369ec6544b7', '真实姓名', '邮箱', '电话', 1, 1, ',1,2,3,4,5,6,7,11,');

-- --------------------------------------------------------

--
-- 表的结构 `dy_ads`
--

CREATE TABLE `dy_ads` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `taid` smallint(5) UNSIGNED NOT NULL DEFAULT '0',
  `orders` int(10) NOT NULL DEFAULT '0',
  `name` char(100) NOT NULL,
  `type` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `adsw` smallint(5) UNSIGNED NOT NULL DEFAULT '0',
  `adsh` smallint(5) UNSIGNED NOT NULL DEFAULT '0',
  `adfile` char(200) NOT NULL,
  `body` text NOT NULL,
  `gourl` char(200) NOT NULL,
  `target` char(8) NOT NULL,
  `isshow` tinyint(1) UNSIGNED NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `dy_ads`
--

INSERT INTO `dy_ads` (`id`, `taid`, `orders`, `name`, `type`, `adsw`, `adsh`, `adfile`, `body`, `gourl`, `target`, `isshow`) VALUES
(1, 1, 0, '广告1', 1, 1024, 208, '/uploads/gg/1.jpg', '<a href=\"http://server.bxgov.cn/\" target=\"_self\"><img src=\"/uploads/gg/1.jpg\" width=\"1024\" height=\"208\" /></a>', 'http://server.bxgov.cn/', 'self', 1);

-- --------------------------------------------------------

--
-- 表的结构 `dy_adstype`
--

CREATE TABLE `dy_adstype` (
  `taid` smallint(5) NOT NULL,
  `name` char(100) NOT NULL,
  `adsw` smallint(5) UNSIGNED NOT NULL DEFAULT '0',
  `adsh` smallint(5) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `dy_adstype`
--

INSERT INTO `dy_adstype` (`taid`, `name`, `adsw`, `adsh`) VALUES
(1, '头部通栏banner', 1024, 208);

-- --------------------------------------------------------

--
-- 表的结构 `dy_article`
--

CREATE TABLE `dy_article` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `tid` smallint(5) UNSIGNED NOT NULL DEFAULT '0',
  `sid` smallint(5) UNSIGNED NOT NULL DEFAULT '0',
  `isshow` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `title` char(100) NOT NULL,
  `style` char(60) NOT NULL,
  `trait` char(20) NOT NULL,
  `gourl` char(255) NOT NULL,
  `htmlfile` char(100) NOT NULL,
  `htmlurl` char(255) NOT NULL,
  `addtime` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `hits` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `litpic` char(255) NOT NULL,
  `orders` int(10) NOT NULL DEFAULT '0',
  `mrank` smallint(5) NOT NULL DEFAULT '0',
  `mgold` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `keywords` char(200) NOT NULL,
  `description` char(255) NOT NULL,
  `user` char(30) NOT NULL,
  `usertype` tinyint(2) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `dy_article`
--

INSERT INTO `dy_article` (`id`, `tid`, `sid`, `isshow`, `title`, `style`, `trait`, `gourl`, `htmlfile`, `htmlurl`, `addtime`, `hits`, `litpic`, `orders`, `mrank`, `mgold`, `keywords`, `description`, `user`, `usertype`) VALUES
(58, 2, 0, 1, '半夏公益服', '', '', '', '', '', 1702282290, 4, '', 0, 0, 0, '', '', 'quanhc', 1);

-- --------------------------------------------------------

--
-- 表的结构 `dy_article_field`
--

CREATE TABLE `dy_article_field` (
  `aid` mediumint(8) UNSIGNED NOT NULL DEFAULT '0',
  `body` mediumtext NOT NULL,
  `date` int(10) NOT NULL DEFAULT '0',
  `empiric` char(200) DEFAULT NULL,
  `ver` varchar(16) DEFAULT NULL,
  `line` char(200) DEFAULT NULL,
  `qq` varchar(12) DEFAULT NULL,
  `link` varchar(100) DEFAULT NULL,
  `summary` text
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `dy_article_field`
--

INSERT INTO `dy_article_field` (`aid`, `body`, `date`, `empiric`, `ver`, `line`, `qq`, `link`, `summary`) VALUES
(58, '部分圈钱服与我们公益服撞名 并窃取我们的劳动成果 注意甄别&lt;br /&gt;半夏公益服纯免费&lt;br /&gt;只要是以购买/赞助的名义诱导你付钱来给你任何虚拟物品的就是圈钱服&lt;br /&gt;我们也从来不会去售卖任何虚拟物品 如:账号 权限 等&lt;br /&gt;半夏公益服将一直致力于成为公益服的标杆', 1702281000, '|星铁|', '1.5', '|中国境内|', '3511676329', 'WWW.baidu.com', '免费的公益服'),
(41, '经典97D版/巅峰对决03K版双区同开,无会员送全属', 1382970720, '', '0.97D/1.', '极速双线', '978516901', 'www.56mu.net', NULL),
(42, '经典97D版/巅峰对决03K版双区同开,无会员送全属', 1382971020, '小退满级', '0.97/1.0', 'BGP多线', '978516901', 'www.56mu.net', NULL);

-- --------------------------------------------------------

--
-- 表的结构 `dy_classtype`
--

CREATE TABLE `dy_classtype` (
  `tid` smallint(5) UNSIGNED NOT NULL,
  `molds` char(20) NOT NULL,
  `pid` smallint(5) UNSIGNED NOT NULL DEFAULT '0',
  `classname` char(50) NOT NULL,
  `gourl` char(255) NOT NULL,
  `litpic` char(200) NOT NULL,
  `title` char(100) NOT NULL,
  `keywords` char(255) NOT NULL,
  `description` varchar(300) NOT NULL,
  `isindex` tinyint(1) UNSIGNED NOT NULL DEFAULT '1',
  `t_index` char(50) NOT NULL,
  `t_list` char(50) NOT NULL,
  `t_listimg` char(50) NOT NULL,
  `t_listb` char(50) NOT NULL,
  `t_content` char(50) NOT NULL,
  `listnum` mediumint(8) UNSIGNED NOT NULL DEFAULT '0',
  `htmldir` char(100) NOT NULL,
  `htmlfile` char(100) NOT NULL,
  `mrank` smallint(5) NOT NULL DEFAULT '0',
  `msubmit` smallint(5) NOT NULL DEFAULT '0',
  `orders` int(10) NOT NULL DEFAULT '0',
  `body` mediumtext NOT NULL,
  `mshow` tinyint(1) UNSIGNED NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `dy_classtype`
--

INSERT INTO `dy_classtype` (`tid`, `molds`, `pid`, `classname`, `gourl`, `litpic`, `title`, `keywords`, `description`, `isindex`, `t_index`, `t_list`, `t_listimg`, `t_listb`, `t_content`, `listnum`, `htmldir`, `htmlfile`, `mrank`, `msubmit`, `orders`, `body`, `mshow`) VALUES
(1, 'article', 0, '品牌推荐', '', '', '奇迹汇', '奇迹汇', '品牌推荐', 1, 'list_index.html', 'list.html', 'list_image.html', 'list_body.html', 'article.html', 20, '', '', 0, 0, 0, '关于我们...内容建设中...', 1),
(2, 'article', 0, '普通推荐', '', '', '奇迹汇', '奇迹汇', '普通推荐', 1, 'list_index.html', 'list.html', 'list_image.html', 'list_body.html', 'article.html', 20, '', '', 0, 1, 0, '', 1),
(3, 'article', 0, '新服预告', '', '', '奇迹汇', '奇迹汇', '新服预告', 1, 'list_index.html', 'list.html', 'list_image.html', 'list_body.html', 'article.html', 20, '', '', 0, 1, 0, '', 1),
(4, 'article', 0, '站内新闻', '', '', '奇迹汇', '奇迹汇', '', 1, 'list_index.html', 'list.html', 'list_image.html', 'list_body.html', 'article.html', 20, '', '', 0, 0, 0, '', 0),
(5, 'article', 0, '行业动态', '', '', '奇迹汇', '奇迹汇', '', 1, 'list_index.html', 'list.html', 'list_image.html', 'list_body.html', 'article.html', 20, '', '', 0, 0, 0, '客户服务...内容建设中...', 0),
(6, 'article', 0, '技术文章', '', '', '奇迹汇', '奇迹汇', '', 1, 'list_index.html', 'list.html', 'list_image.html', 'list_body.html', 'article.html', 20, '', '', 0, 0, 0, '营销网络...内容建设中...', 0),
(7, 'article', 0, '联系我们', '', '', '奇迹汇', '奇迹汇', '', 3, 'list_index.html', 'list.html', 'list_image.html', 'list_body.html', 'article.html', 20, '', '', 0, 0, 0, '联系我们...内容建设中...', 0),
(11, 'article', 0, '在线留言', '', '', '奇迹汇', '奇迹汇', '', 1, 'list_index.html', 'list.html', 'list_image.html', 'list_body.html', 'article.html', 10, '', '', 0, -1, 0, '', 0);

-- --------------------------------------------------------

--
-- 表的结构 `dy_comment`
--

CREATE TABLE `dy_comment` (
  `cid` mediumint(8) UNSIGNED NOT NULL,
  `aid` mediumint(8) UNSIGNED NOT NULL,
  `molds` char(20) NOT NULL,
  `isshow` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `body` text NOT NULL,
  `reply` text NOT NULL,
  `addtime` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `retime` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `user` char(30) NOT NULL,
  `ruser` char(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `dy_custom`
--

CREATE TABLE `dy_custom` (
  `id` smallint(8) UNSIGNED NOT NULL,
  `name` char(200) NOT NULL,
  `dir` char(100) NOT NULL,
  `template` char(100) NOT NULL,
  `file` char(200) NOT NULL,
  `html` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `dy_custom`
--

INSERT INTO `dy_custom` (`id`, `name`, `dir`, `template`, `file`, `html`) VALUES
(3, 'Release', '', 'index.html', 'release.html', 1);

-- --------------------------------------------------------

--
-- 表的结构 `dy_fields`
--

CREATE TABLE `dy_fields` (
  `fid` mediumint(8) UNSIGNED NOT NULL,
  `molds` char(20) NOT NULL,
  `fieldsname` char(20) NOT NULL,
  `fields` char(20) NOT NULL,
  `fieldstype` char(20) NOT NULL,
  `fieldslong` smallint(5) UNSIGNED NOT NULL DEFAULT '0',
  `selects` text NOT NULL,
  `fieldorder` int(10) NOT NULL DEFAULT '0',
  `issubmit` tinyint(1) UNSIGNED NOT NULL DEFAULT '1',
  `lists` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `fieldshow` tinyint(1) UNSIGNED NOT NULL DEFAULT '1',
  `types` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `dy_fields`
--

INSERT INTO `dy_fields` (`fid`, `molds`, `fieldsname`, `fields`, `fieldstype`, `fieldslong`, `selects`, `fieldorder`, `issubmit`, `lists`, `fieldshow`, `types`) VALUES
(6, 'article', '开区时间', 'date', 'time', 0, '', 0, 1, 1, 1, '|1|2|3|'),
(7, 'article', '已开设的游戏', 'empiric', 'checkbox', 0, '原神=原神,星铁=星铁,崩坏3=崩坏3,其他=其他', 0, 1, 1, 1, '|1|2|3|'),
(8, 'article', '版本', 'ver', 'varchar', 16, '', 0, 1, 1, 1, '|1|2|3|'),
(9, 'article', '网络线路', 'line', 'checkbox', 0, '中国境内=中国境内,港澳台=港澳台,海外=海外', 0, 1, 1, 1, '|1|2|3|'),
(10, 'article', '客服QQ', 'qq', 'varchar', 12, '', 0, 1, 1, 1, '|1|2|3|'),
(11, 'article', '官方网站', 'link', 'varchar', 100, '', 0, 1, 1, 1, '|1|2|3|'),
(12, 'article', '这里是特色简介/上面的游戏设置是具体信息', 'summary', 'text', 0, '', 1, 1, 1, 1, '|1|2|3|');

-- --------------------------------------------------------

--
-- 表的结构 `dy_funs`
--

CREATE TABLE `dy_funs` (
  `fid` smallint(5) UNSIGNED NOT NULL,
  `funs` char(20) NOT NULL,
  `fundb` char(255) NOT NULL,
  `name` char(20) NOT NULL,
  `isshow` tinyint(1) UNSIGNED NOT NULL DEFAULT '1',
  `afiles` text NOT NULL,
  `version` char(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `dy_funs`
--

INSERT INTO `dy_funs` (`fid`, `funs`, `fundb`, `name`, `isshow`, `afiles`, `version`) VALUES
(31, 'ads', 'ads,adstype', '广告', 1, 'doyo/admin/a_ads.php,include/class/c_ads.php,doyo/admin/template/ads.html', '1.0'),
(32, 'comment', 'comment', '评论', 1, 'doyo/admin/a_comment.php,include/class/c_comment.php,doyo/admin/template/comment.html,doyo/comment.php', '1.0'),
(33, 'links', 'links,linkstype', '友情链接', 1, 'doyo/admin/a_links.php,include/class/c_links.php,doyo/admin/template/links.html', '1.0'),
(34, 'member', 'member,member_field,member_group,member_file', '会员', 1, 'doyo/admin/a_member.php,include/class/c_member.php,doyo/admin/template/member.html,doyo/member.php', '1.0'),
(35, 'special', 'special', '专题', 1, 'doyo/admin/a_special.php,include/class/c_special.php,doyo/admin/template/special.html,doyo/admin/template/special_edit.html,doyo/special.php', '1.0');

-- --------------------------------------------------------

--
-- 表的结构 `dy_labelcus`
--

CREATE TABLE `dy_labelcus` (
  `id` smallint(5) NOT NULL,
  `name` char(50) NOT NULL,
  `body` text NOT NULL,
  `type` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `dy_labelcus`
--

INSERT INTO `dy_labelcus` (`id`, `name`, `body`, `type`) VALUES
(4, '站长QQ', '3511676329', 1),
(5, '公告1', '私服发布网站-半夏 欢迎各位服主提交', 1),
(6, '公告2', '私服发布网站-半夏 欢迎各位服主提交', 1),
(7, '公告3', '私服发布网站-半夏 欢迎各位服主提交', 1),
(8, '公告4', '私服发布网站-半夏 欢迎各位服主提交', 1),
(9, '投诉邮箱', '3511676329@qq.com', 1);

-- --------------------------------------------------------

--
-- 表的结构 `dy_links`
--

CREATE TABLE `dy_links` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `taid` smallint(5) UNSIGNED NOT NULL DEFAULT '0',
  `orders` int(10) NOT NULL DEFAULT '0',
  `name` char(100) NOT NULL,
  `image` char(200) NOT NULL,
  `gourl` char(200) NOT NULL,
  `isshow` tinyint(1) UNSIGNED NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `dy_linkstype`
--

CREATE TABLE `dy_linkstype` (
  `taid` smallint(5) NOT NULL,
  `name` char(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `dy_linkstype`
--

INSERT INTO `dy_linkstype` (`taid`, `name`) VALUES
(1, '门户导航');

-- --------------------------------------------------------

--
-- 表的结构 `dy_member`
--

CREATE TABLE `dy_member` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `user` char(20) NOT NULL,
  `pass` char(32) NOT NULL,
  `email` char(100) NOT NULL,
  `gid` smallint(5) NOT NULL DEFAULT '1',
  `money` decimal(10,2) NOT NULL DEFAULT '0.00',
  `regtime` int(10) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `dy_member`
--

INSERT INTO `dy_member` (`id`, `user`, `pass`, `email`, `gid`, `money`, `regtime`) VALUES
(16, 'quanhc', 'a19ef332ab32493dbd4ca606398ad511', '3511676329@qq.com', 1, '0.00', 1702280933);

-- --------------------------------------------------------

--
-- 表的结构 `dy_member_field`
--

CREATE TABLE `dy_member_field` (
  `aid` mediumint(8) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `dy_member_field`
--

INSERT INTO `dy_member_field` (`aid`) VALUES
(16);

-- --------------------------------------------------------

--
-- 表的结构 `dy_member_file`
--

CREATE TABLE `dy_member_file` (
  `id` int(8) UNSIGNED NOT NULL,
  `uid` mediumint(8) UNSIGNED NOT NULL DEFAULT '0',
  `url` char(255) NOT NULL,
  `size` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `fields` char(20) NOT NULL,
  `hand` int(9) UNSIGNED NOT NULL DEFAULT '0',
  `aid` mediumint(8) UNSIGNED NOT NULL DEFAULT '0',
  `molds` char(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `dy_member_group`
--

CREATE TABLE `dy_member_group` (
  `gid` smallint(5) UNSIGNED NOT NULL,
  `name` char(20) NOT NULL,
  `weight` int(11) NOT NULL DEFAULT '0',
  `audit` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `submit` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `filetype` char(255) NOT NULL,
  `filesize` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `fileallsize` int(10) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `dy_member_group`
--

INSERT INTO `dy_member_group` (`gid`, `name`, `weight`, `audit`, `submit`, `filetype`, `filesize`, `fileallsize`) VALUES
(1, '普通会员', 1, 0, 1, 'jpg,gif,jpeg,png', 102400, 502400);

-- --------------------------------------------------------

--
-- 表的结构 `dy_message`
--

CREATE TABLE `dy_message` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `tid` smallint(5) UNSIGNED NOT NULL DEFAULT '0',
  `isshow` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `title` char(100) NOT NULL,
  `addtime` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `retime` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `orders` int(10) NOT NULL DEFAULT '0',
  `user` char(30) NOT NULL,
  `body` text NOT NULL,
  `reply` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `dy_message_field`
--

CREATE TABLE `dy_message_field` (
  `aid` mediumint(8) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `dy_molds`
--

CREATE TABLE `dy_molds` (
  `mid` smallint(5) UNSIGNED NOT NULL,
  `molds` char(20) NOT NULL,
  `molddb` char(255) NOT NULL,
  `moldname` char(20) NOT NULL,
  `orders` int(10) NOT NULL DEFAULT '0',
  `t_index` char(50) NOT NULL,
  `t_list` char(50) NOT NULL,
  `t_listimg` char(50) NOT NULL,
  `t_listb` char(50) NOT NULL,
  `t_content` char(50) NOT NULL,
  `isshow` tinyint(1) UNSIGNED NOT NULL DEFAULT '1',
  `afiles` text NOT NULL,
  `version` char(20) NOT NULL,
  `sys` tinyint(1) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `dy_molds`
--

INSERT INTO `dy_molds` (`mid`, `molds`, `molddb`, `moldname`, `orders`, `t_index`, `t_list`, `t_listimg`, `t_listb`, `t_content`, `isshow`, `afiles`, `version`, `sys`) VALUES
(1, 'article', 'article', '文章', 0, 'list_index.html', 'list.html', 'list_image.html', 'list_body.html', 'article.html', 1, '', '1.0', 1),
(6, 'message', 'message,message_field', '交互(留言)', 0, 'message.html', 'message.html', 'message.html', 'message.html', 'message.html', 1, 'doyo/admin/a_message.php,include/class/c_message.php,doyo/admin/template/message.html,doyo/admin/template/message_edit.html,doyo/message.php', '1.0', 0),
(2, 'product', 'product', '产品', 0, 'list_index.html', 'list.html', 'list_image.html', 'list_body.html', 'product.html', 1, '', '1.0', 1);

-- --------------------------------------------------------

--
-- 表的结构 `dy_product`
--

CREATE TABLE `dy_product` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `tid` smallint(5) UNSIGNED NOT NULL DEFAULT '0',
  `sid` smallint(5) UNSIGNED NOT NULL DEFAULT '0',
  `isshow` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `title` char(100) NOT NULL,
  `style` char(60) NOT NULL,
  `trait` char(20) NOT NULL,
  `gourl` char(255) NOT NULL,
  `htmlfile` char(100) NOT NULL,
  `htmlurl` char(255) NOT NULL,
  `addtime` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `hits` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `litpic` char(255) NOT NULL,
  `photo` text NOT NULL,
  `orders` int(10) NOT NULL DEFAULT '0',
  `price` decimal(10,2) UNSIGNED NOT NULL DEFAULT '0.00',
  `mrank` smallint(5) NOT NULL DEFAULT '0',
  `mgold` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `keywords` char(200) NOT NULL,
  `description` char(255) NOT NULL,
  `user` char(30) NOT NULL,
  `usertype` tinyint(2) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `dy_product_field`
--

CREATE TABLE `dy_product_field` (
  `aid` mediumint(8) UNSIGNED NOT NULL DEFAULT '0',
  `body` mediumtext NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `dy_special`
--

CREATE TABLE `dy_special` (
  `sid` smallint(5) UNSIGNED NOT NULL,
  `molds` char(20) NOT NULL,
  `name` char(50) NOT NULL,
  `litpic` char(200) NOT NULL,
  `title` char(100) NOT NULL,
  `keywords` char(255) NOT NULL,
  `description` varchar(300) NOT NULL,
  `gourl` char(255) NOT NULL,
  `isindex` tinyint(1) UNSIGNED NOT NULL DEFAULT '1',
  `t_index` char(50) NOT NULL,
  `t_list` char(50) NOT NULL,
  `t_listb` char(50) NOT NULL,
  `listnum` mediumint(8) UNSIGNED NOT NULL DEFAULT '0',
  `htmldir` char(100) NOT NULL,
  `htmlfile` char(100) NOT NULL,
  `orders` int(10) NOT NULL DEFAULT '0',
  `body` mediumtext NOT NULL,
  `isshow` tinyint(1) UNSIGNED NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `dy_traits`
--

CREATE TABLE `dy_traits` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `name` char(50) NOT NULL,
  `molds` char(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `dy_traits`
--

INSERT INTO `dy_traits` (`id`, `name`, `molds`) VALUES
(1, '头条', 'article'),
(2, '推荐', 'article'),
(3, '头条', 'product'),
(4, '推荐', 'product');

-- --------------------------------------------------------

--
-- 表的结构 `dy_update`
--

CREATE TABLE `dy_update` (
  `id` int(11) NOT NULL,
  `version` char(10) NOT NULL,
  `newupdate` char(15) NOT NULL,
  `uptime` int(10) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转储表的索引
--

--
-- 表的索引 `dy_admin_group`
--
ALTER TABLE `dy_admin_group`
  ADD PRIMARY KEY (`gid`);

--
-- 表的索引 `dy_admin_per`
--
ALTER TABLE `dy_admin_per`
  ADD PRIMARY KEY (`pid`);

--
-- 表的索引 `dy_admin_user`
--
ALTER TABLE `dy_admin_user`
  ADD PRIMARY KEY (`auid`);

--
-- 表的索引 `dy_ads`
--
ALTER TABLE `dy_ads`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `dy_adstype`
--
ALTER TABLE `dy_adstype`
  ADD PRIMARY KEY (`taid`);

--
-- 表的索引 `dy_article`
--
ALTER TABLE `dy_article`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orbye` (`orders`,`addtime`),
  ADD KEY `article` (`isshow`,`tid`,`trait`,`sid`);

--
-- 表的索引 `dy_article_field`
--
ALTER TABLE `dy_article_field`
  ADD PRIMARY KEY (`aid`);

--
-- 表的索引 `dy_classtype`
--
ALTER TABLE `dy_classtype`
  ADD PRIMARY KEY (`tid`);

--
-- 表的索引 `dy_comment`
--
ALTER TABLE `dy_comment`
  ADD PRIMARY KEY (`cid`);

--
-- 表的索引 `dy_custom`
--
ALTER TABLE `dy_custom`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `dy_fields`
--
ALTER TABLE `dy_fields`
  ADD PRIMARY KEY (`fid`);

--
-- 表的索引 `dy_funs`
--
ALTER TABLE `dy_funs`
  ADD PRIMARY KEY (`fid`);

--
-- 表的索引 `dy_labelcus`
--
ALTER TABLE `dy_labelcus`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `dy_links`
--
ALTER TABLE `dy_links`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `dy_linkstype`
--
ALTER TABLE `dy_linkstype`
  ADD PRIMARY KEY (`taid`);

--
-- 表的索引 `dy_member`
--
ALTER TABLE `dy_member`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `dy_member_field`
--
ALTER TABLE `dy_member_field`
  ADD PRIMARY KEY (`aid`);

--
-- 表的索引 `dy_member_file`
--
ALTER TABLE `dy_member_file`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user` (`uid`,`url`,`size`,`fields`,`hand`);

--
-- 表的索引 `dy_member_group`
--
ALTER TABLE `dy_member_group`
  ADD PRIMARY KEY (`gid`);

--
-- 表的索引 `dy_message`
--
ALTER TABLE `dy_message`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orbye` (`orders`,`addtime`),
  ADD KEY `article` (`isshow`,`tid`);

--
-- 表的索引 `dy_message_field`
--
ALTER TABLE `dy_message_field`
  ADD PRIMARY KEY (`aid`);

--
-- 表的索引 `dy_molds`
--
ALTER TABLE `dy_molds`
  ADD PRIMARY KEY (`mid`);

--
-- 表的索引 `dy_product`
--
ALTER TABLE `dy_product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orbye` (`orders`,`addtime`),
  ADD KEY `product` (`isshow`,`tid`,`trait`,`sid`);

--
-- 表的索引 `dy_product_field`
--
ALTER TABLE `dy_product_field`
  ADD PRIMARY KEY (`aid`);

--
-- 表的索引 `dy_special`
--
ALTER TABLE `dy_special`
  ADD PRIMARY KEY (`sid`);

--
-- 表的索引 `dy_traits`
--
ALTER TABLE `dy_traits`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `dy_update`
--
ALTER TABLE `dy_update`
  ADD PRIMARY KEY (`id`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `dy_admin_group`
--
ALTER TABLE `dy_admin_group`
  MODIFY `gid` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 使用表AUTO_INCREMENT `dy_admin_per`
--
ALTER TABLE `dy_admin_per`
  MODIFY `pid` tinyint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- 使用表AUTO_INCREMENT `dy_admin_user`
--
ALTER TABLE `dy_admin_user`
  MODIFY `auid` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 使用表AUTO_INCREMENT `dy_ads`
--
ALTER TABLE `dy_ads`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- 使用表AUTO_INCREMENT `dy_adstype`
--
ALTER TABLE `dy_adstype`
  MODIFY `taid` smallint(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- 使用表AUTO_INCREMENT `dy_article`
--
ALTER TABLE `dy_article`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- 使用表AUTO_INCREMENT `dy_classtype`
--
ALTER TABLE `dy_classtype`
  MODIFY `tid` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- 使用表AUTO_INCREMENT `dy_comment`
--
ALTER TABLE `dy_comment`
  MODIFY `cid` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- 使用表AUTO_INCREMENT `dy_custom`
--
ALTER TABLE `dy_custom`
  MODIFY `id` smallint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- 使用表AUTO_INCREMENT `dy_fields`
--
ALTER TABLE `dy_fields`
  MODIFY `fid` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- 使用表AUTO_INCREMENT `dy_funs`
--
ALTER TABLE `dy_funs`
  MODIFY `fid` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- 使用表AUTO_INCREMENT `dy_labelcus`
--
ALTER TABLE `dy_labelcus`
  MODIFY `id` smallint(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- 使用表AUTO_INCREMENT `dy_links`
--
ALTER TABLE `dy_links`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- 使用表AUTO_INCREMENT `dy_linkstype`
--
ALTER TABLE `dy_linkstype`
  MODIFY `taid` smallint(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 使用表AUTO_INCREMENT `dy_member`
--
ALTER TABLE `dy_member`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- 使用表AUTO_INCREMENT `dy_member_file`
--
ALTER TABLE `dy_member_file`
  MODIFY `id` int(8) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `dy_member_group`
--
ALTER TABLE `dy_member_group`
  MODIFY `gid` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 使用表AUTO_INCREMENT `dy_message`
--
ALTER TABLE `dy_message`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- 使用表AUTO_INCREMENT `dy_molds`
--
ALTER TABLE `dy_molds`
  MODIFY `mid` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- 使用表AUTO_INCREMENT `dy_product`
--
ALTER TABLE `dy_product`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- 使用表AUTO_INCREMENT `dy_special`
--
ALTER TABLE `dy_special`
  MODIFY `sid` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- 使用表AUTO_INCREMENT `dy_traits`
--
ALTER TABLE `dy_traits`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- 使用表AUTO_INCREMENT `dy_update`
--
ALTER TABLE `dy_update`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
