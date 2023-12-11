-- phpMyAdmin SQL Dump
-- version 4.1.8
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 2015-06-03 01:52:52
-- 服务器版本： 5.1.73-cll
-- PHP Version: 5.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `glngbnwx_fabu_demo`
--

-- --------------------------------------------------------

--
-- 表的结构 `dy_admin_group`
--

CREATE TABLE IF NOT EXISTS `dy_admin_group` (
  `gid` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(20) NOT NULL,
  `audit` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `paction` text NOT NULL,
  PRIMARY KEY (`gid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `dy_admin_group`
--

INSERT INTO `dy_admin_group` (`gid`, `name`, `audit`, `paction`) VALUES
(1, '录入员', 0, ',a_html,a_article,a_article_add,a_article_edit,a_article_del,a_article_audit,a_product,a_product_add,a_product_edit,a_product_del,a_product_audit,a_message,a_message_edit,a_message_del,a_message_audit,a_article_index,a_classtypes_index,a_fields_info,a_adminuser_edituser,uploads,a_label,a_sys_ecache,a_product_index,');

-- --------------------------------------------------------

--
-- 表的结构 `dy_admin_per`
--

CREATE TABLE IF NOT EXISTS `dy_admin_per` (
  `pid` tinyint(5) unsigned NOT NULL AUTO_INCREMENT,
  `action` char(50) NOT NULL,
  `name` char(20) NOT NULL,
  `up` tinyint(5) NOT NULL DEFAULT '0',
  `no` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `orders` int(10) unsigned NOT NULL DEFAULT '0',
  `molds` char(30) NOT NULL,
  PRIMARY KEY (`pid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=85 ;

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

CREATE TABLE IF NOT EXISTS `dy_admin_user` (
  `auid` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `auser` char(20) NOT NULL,
  `apass` char(32) NOT NULL,
  `aname` char(30) NOT NULL,
  `amail` char(100) NOT NULL,
  `atel` char(100) NOT NULL,
  `level` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `gid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `pclasstype` text NOT NULL,
  PRIMARY KEY (`auid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `dy_admin_user`
--

INSERT INTO `dy_admin_user` (`auid`, `auser`, `apass`, `aname`, `amail`, `atel`, `level`, `gid`, `pclasstype`) VALUES
(1, 'admin', '86f3059b228c8acf99e69734b6bb32cc', '真实姓名', '邮箱', '电话', 1, 1, '');

-- --------------------------------------------------------

--
-- 表的结构 `dy_ads`
--

CREATE TABLE IF NOT EXISTS `dy_ads` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `taid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `orders` int(10) NOT NULL DEFAULT '0',
  `name` char(100) NOT NULL,
  `type` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `adsw` smallint(5) unsigned NOT NULL DEFAULT '0',
  `adsh` smallint(5) unsigned NOT NULL DEFAULT '0',
  `adfile` char(200) NOT NULL,
  `body` text NOT NULL,
  `gourl` char(200) NOT NULL,
  `target` char(8) NOT NULL,
  `isshow` tinyint(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- 转存表中的数据 `dy_ads`
--

INSERT INTO `dy_ads` (`id`, `taid`, `orders`, `name`, `type`, `adsw`, `adsh`, `adfile`, `body`, `gourl`, `target`, `isshow`) VALUES
(1, 1, 0, '广告1', 1, 1024, 208, '/uploads/2015/05/291706034742.jpg', '<a href="http://fabu.akmu.net/" target="_self"><img src="/uploads/2015/05/291706034742.jpg" width="1024" height="208" /></a>', 'http://fabu.akmu.net/', 'self', 1),
(2, 1, 0, '广告2', 1, 1024, 208, '/uploads/2015/05/291705276393.jpg', '<a href="http://fabu.akmu.net/" target="_self"><img src="/uploads/2015/05/291705276393.jpg" width="1024" height="208" /></a>', 'http://fabu.akmu.net/', 'self', 1),
(3, 1, 0, '广告3', 1, 1024, 208, '/uploads/2015/05/291704548572.jpg', '<a href="http://fabu.akmu.net/" target="_self"><img src="/uploads/2015/05/291704548572.jpg" width="1024" height="208" /></a>', 'http://fabu.akmu.net/', 'self', 1);

-- --------------------------------------------------------

--
-- 表的结构 `dy_adstype`
--

CREATE TABLE IF NOT EXISTS `dy_adstype` (
  `taid` smallint(5) NOT NULL AUTO_INCREMENT,
  `name` char(100) NOT NULL,
  `adsw` smallint(5) unsigned NOT NULL DEFAULT '0',
  `adsh` smallint(5) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`taid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `dy_adstype`
--

INSERT INTO `dy_adstype` (`taid`, `name`, `adsw`, `adsh`) VALUES
(1, '头部通栏banner', 1024, 208);

-- --------------------------------------------------------

--
-- 表的结构 `dy_article`
--

CREATE TABLE IF NOT EXISTS `dy_article` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `tid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `sid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `isshow` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `title` char(100) NOT NULL,
  `style` char(60) NOT NULL,
  `trait` char(20) NOT NULL,
  `gourl` char(255) NOT NULL,
  `htmlfile` char(100) NOT NULL,
  `htmlurl` char(255) NOT NULL,
  `addtime` int(10) unsigned NOT NULL DEFAULT '0',
  `hits` int(10) unsigned NOT NULL DEFAULT '0',
  `litpic` char(255) NOT NULL,
  `orders` int(10) NOT NULL DEFAULT '0',
  `mrank` smallint(5) NOT NULL DEFAULT '0',
  `mgold` int(10) unsigned NOT NULL DEFAULT '0',
  `keywords` char(200) NOT NULL,
  `description` char(255) NOT NULL,
  `user` char(30) NOT NULL,
  `usertype` tinyint(2) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `orbye` (`orders`,`addtime`),
  KEY `article` (`isshow`,`tid`,`trait`,`sid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=58 ;

--
-- 转存表中的数据 `dy_article`
--

INSERT INTO `dy_article` (`id`, `tid`, `sid`, `isshow`, `title`, `style`, `trait`, `gourl`, `htmlfile`, `htmlurl`, `addtime`, `hits`, `litpic`, `orders`, `mrank`, `mgold`, `keywords`, `description`, `user`, `usertype`) VALUES
(36, 1, 0, 1, '梦之奇迹', '', '', '', '', 'html/article/36.html', 1382961600, 23, '', 0, 0, 0, '梦之奇迹,奇迹,奇迹mu,奇迹汇', '', 'test', 1),
(43, 1, 0, 1, '英雄奇迹', '', '', '', '', 'html/article/43.html', 1382971140, 23, '', 0, 0, 0, '英雄奇迹,奇迹,奇迹mu,奇迹汇', '', 'admin', 0),
(44, 1, 0, 1, '怀旧奇迹', '', '', '', '', 'html/article/44.html', 1382971260, 39, '', 0, 0, 0, '怀旧奇迹,奇迹,奇迹mu,奇迹汇', '', 'admin', 0),
(45, 2, 0, 1, '天空之城', '', '', '', '', 'html/article/45.html', 1382971680, 16, '', 0, 0, 0, '天空之城,奇迹,奇迹mu,奇迹汇', '', 'admin', 0),
(6, 1, 0, 1, '木瓜奇迹', '', '', '', '', 'html/article/6.html', 1335414300, 120, '', 10, 0, 0, '木瓜奇迹,奇迹,奇迹mu,奇迹汇', '', 'admin', 0),
(46, 2, 0, 1, '小牛奇迹', '', '', '', '', 'html/article/46.html', 1382972160, 23, '', 0, 0, 0, '小牛奇迹,奇迹,奇迹mu,奇迹汇', '', 'admin', 0),
(8, 1, 0, 1, '顶尖奇迹', '', '', '', '', 'html/article/8.html', 1337952360, 27, '', 0, 0, 0, '顶尖奇迹,奇迹,奇迹mu,奇迹汇', '', 'admin', 0),
(37, 1, 0, 1, '天战奇迹', '', '', '', '', 'html/article/37.html', 1382805720, 35, '', 0, 0, 0, '天战奇迹,奇迹,奇迹mu,奇迹汇', '', 'test', 1),
(38, 1, 0, 1, '战神奇迹', '', '', '', '', 'html/article/38.html', 1382853720, 25, '', 0, 0, 0, '战神奇迹,奇迹,奇迹mu,奇迹汇', '', 'test2', 1),
(39, 3, 0, 1, '丹佛小镇', '', '', '', '', 'html/article/39.html', 1385652840, 85, '', 0, 0, 0, '', '', 'test2', 1),
(40, 2, 0, 1, '西游迹', '', '', '', '', 'html/article/40.html', 1382970300, 25, '', 0, 0, 0, '西游迹,奇迹,奇迹mu,奇迹汇', '', 'admin', 0),
(47, 2, 0, 1, '皓月奇迹', '', '', '', '', 'html/article/47.html', 1382972820, 30, '', 0, 0, 0, '皓月奇迹,奇迹,奇迹mu,奇迹汇', '', 'admin', 0),
(20, 3, 0, 1, '团战奇迹', '', '', '', '', 'html/article/20.html', 1382961600, 19, '', 0, 0, 0, '团战奇迹,奇迹,奇迹mu,奇迹汇', '', 'admin', 0),
(48, 2, 0, 1, '天使奇迹', '', '', '', '', 'html/article/48.html', 1382973060, 17, '', 0, 0, 0, '天使奇迹,奇迹,奇迹mu,奇迹汇', '', 'admin', 0),
(49, 2, 0, 1, '争霸奇迹', '', '', '', '', 'html/article/49.html', 1382973240, 41, '', 0, 0, 0, '争霸奇迹,奇迹,奇迹mu,奇迹汇', '', 'admin', 0),
(50, 2, 0, 1, '动力奇迹', '', '', '', '', 'html/article/50.html', 1382973420, 29, '', 0, 0, 0, '动力奇迹,奇迹,奇迹mu,奇迹汇', '', 'admin', 0),
(51, 3, 0, 1, '剑舞江南', '', '', '', '', 'html/article/51.html', 1382973600, 25, '', 0, 0, 0, '剑舞江南,奇迹,奇迹mu,奇迹汇', '', 'admin', 0),
(52, 4, 0, 1, '自由发布奇迹私服', '', '', '', '', 'html/article/52.html', 1385696640, 37, '', 0, 0, 0, '', '', 'admin', 0),
(53, 5, 0, 1, '十年轮回 奇迹mu新的起航', '', '', '', '', 'html/article/53.html', 1385696640, 43, '', 0, 0, 0, '', '', 'admin', 0),
(54, 6, 0, 1, '在许多年前曾经有个游戏叫奇迹mu', '', '', '', '', 'html/article/54.html', 1385696700, 45, '', 0, 0, 0, '', '夏夜,月明星稀.银杏树下,一位老人对他的孙子讲述着一个故事...', 'admin', 0),
(55, 4, 0, 1, '奇迹汇致力于建设干净的奇迹私服发布站', '', '', '', '', 'html/article/55.html', 1385698440, 51, '', 0, 0, 0, '', '', 'admin', 0),
(56, 2, 0, 1, '永恒奇迹', '', '', '', '', '', 1432891560, 5, '', 0, 0, 0, '', '', 'test', 1),
(57, 3, 0, 1, '土豪奇迹', '', '', '', '', 'html/article/57.html', 1390748820, 2, '', 0, 0, 0, '', '', 'xuhuenn', 1);

-- --------------------------------------------------------

--
-- 表的结构 `dy_article_field`
--

CREATE TABLE IF NOT EXISTS `dy_article_field` (
  `aid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `body` mediumtext NOT NULL,
  `date` int(10) NOT NULL DEFAULT '0',
  `empiric` varchar(8) DEFAULT NULL,
  `ver` varchar(16) DEFAULT NULL,
  `line` char(30) DEFAULT NULL,
  `qq` varchar(12) DEFAULT NULL,
  `link` varchar(100) DEFAULT NULL,
  `summary` text,
  PRIMARY KEY (`aid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `dy_article_field`
--

INSERT INTO `dy_article_field` (`aid`, `body`, `date`, `empiric`, `ver`, `line`, `qq`, `link`, `summary`) VALUES
(6, '999倍－30转－64000点－400级转－首转100级-送3转', 1382875200, '999', '1.09S', 'BGP多线', '2376065951', 'www.mu1717.cc', '999倍－30转－64000点－400级转－首转100级-送3转'),
(8, '满点４万３／旗帜显示／自由骑马／自由３Ｄ／Ｖip封挂', 1382961600, '50', '1.03H', 'BGP多线', '863929747', 'www.sopai.cc', '满点４万３／旗帜显示／自由骑马／自由３Ｄ／Ｖip封挂'),
(20, '小退８Ｗ４，无延迟两连击，自由镶嵌，免费领会员大天', 1382961600, '小退满级', '1.03H', 'BGP多线', '754500177', 'www.akmu.net', '小退８Ｗ４，无延迟两连击，自由镶嵌，免费领会员大天'),
(36, '9999倍,长久稳定,练级领全属,人气火爆', 1382805060, '9999', '1.0D', '极速双线', '1561356238', 'www.506520.com', '9999倍,长久稳定,练级领全属,人气火爆'),
(37, '送转|送4W点|送全属|刷顶级|耐玩|自助镶嵌|高级技师', 1382961600, '9999', '全新S6-EP2', '中国电信', '26009106', 'www.330mu.com', '送转|送4W点|送全属|刷顶级|耐玩|自助镶嵌|高级技师'),
(38, '╱╲888倍，100转，＋５箱，爆全属性 自动封挂╱╲', 1382873400, '888', '1.03K', '极速双线', '898692053', 'www.78mx.com', '╱╲888倍，100转，＋５箱，爆全属性 自动封挂╱╲'),
(39, '[版本介绍] 最新1.03H版,真实大师,真实镶嵌,宝箱掉套,二代攻城激情、全职业无延迟二连系统<br />[线路设置] 服务器使用顶级VIP机房真实双线服务器、使用DNS自动选线技术、给你提供流畅的游戏体验<br />[倍数设置] 200倍经验.100倍大师.各职业每级25/27/30点.前期升级较快,后期经典耐玩&nbsp;<br />[点数设置] 战士/圣导出生送2000点、其他职业均送4000点.统率999,各职业平衡<br />[商店设置] 游戏商店出售各职业+9来年级装备、技能书、转职物品、初级广场票卷、3D合成材料等<br />[在线设置] 大陆在线X店经验印章、广场票卷、幸运符咒、合成保护符咒等生活必须品！&nbsp;<br />[特色设置] 卓越一属1/80 双属性1/120 宝石1/100 羽毛1/110 创造1/60 套装掉率1/70<br />[积分设置] 在线1分钟获得5积分.各种宝石仍商店即可获得积分.CZ=50.SM/MY/YM=20.<br />[特色设置] 开区当天晚上20点-第二天白天8点大陆泡点每分钟获得20积分<br />[离线设置] 为方便上班族交易物品、活跃市场.1线大陆满400可以离线挂机/挂机.离线挂机不会获得积分&nbsp;<br />[奖励设置] 满人物400级可领取本职业3D翅膀.满大师奖励本职业380武器一把<br />[奖励设置] 同一帐号内5个不同角色满大师200(不包括召唤)联系GM领取2W分+强化恶魔.<br />[合成设置] 高级技师开放合+13三属性，合成成功率高达80%,合成失败积分和装备会消失哦&nbsp;<br />[精心设置] 高级技师在开区当天晚上合成成功率为100%。截止到凌晨1点。忘新老玩家莫失良机。<br />[套装掉率] 砍2掉落黑龙级别套装，230掉落380级别套装，安宁掉落荧光石。230回走掉落再生原石。<br />[特色设置] 古战场掉落400套,为方便大家升级。打装备,让玩家不再为装备而忧愁。<br />[爆率设置] 困顿BOSS掉所有套装,冰霜蜘蛛2小时1次.必掉5件装备.80%为卓越.50%为套装.20%出全属性.要组队前往哦！<br />[Boss设置] 海1/卡7/森林1、每30分钟刷新各2只困顿,冰霜孵化之地2小时刷新1只蜘蛛！<br />[Boss设置] BOss集中营，魔炼之地，海魔，天魔，咒怨魔王，森林2，丛琳召唤者，安宁池，炼狱魔王。<br />[宝箱设置] 宝箱完美掉全属套装、+1-+5宝箱可掉落各职业全属性套装备------------查看宝箱详细掉率<br />[扩展设置] 本服长久稳定开放、精心设置、众多游戏活动带你找回曾经的记忆.多种扩展让你傻眼<br />[攻城设置] 每天20:点开启,系统自动随机给予奖励，有几率爆出大天或者大天首饰。请各位盟主切勿错过时间。<br />[攻城设置] 本服不设置不死鸟，还原真实PK。一切只为长久稳定。<br />[连击设置] 完美全职业无延迟二连,所有职业均可二连,速度超快,带你体验无限激情PK的乐趣&nbsp;', 1382961600, '500', '1.03H', 'BGP多线', '394618561', 'www.126.com', '海外华侨玩的服，很多老外快来杀吧'),
(40, '小退８Ｗ４，无延迟两连，自由镶嵌，自由卡马，换顶级无炮灰', 1382970420, '小退满级', '1.03H', '极速双线', '741244948', 'www.573mu.com', '小退８Ｗ４，无延迟两连，自由镶嵌，自由卡马，换顶级无炮灰'),
(41, '经典97D版/巅峰对决03K版双区同开,无会员送全属', 1382970720, '', '0.97D/1.', '极速双线', '978516901', 'www.56mu.net', NULL),
(42, '经典97D版/巅峰对决03K版双区同开,无会员送全属', 1382971020, '小退满级', '0.97/1.0', 'BGP多线', '978516901', 'www.56mu.net', NULL),
(43, '经典97D版/巅峰对决03K版双区同开,无会员送全属', 1382971140, '小退满级', '0.97/1.03', '极速双线', '978516901', 'www.56mu.net', '经典97D版/巅峰对决03K版双区同开,无会员送全属'),
(44, '1.02W真怀旧，人气品牌服，原味经典，封杀一切外挂', 1382971260, '60', '1.02W', '极速双线', '33882497', 'www.255mu.com', '1.02W真怀旧，人气品牌服，原味经典，封杀一切外挂'),
(45, '６╲７╲８╱积分换会员/无炮灰/稳定长久', 1382971680, '100', '1.03H', '极速双线', '577635998', 'www.rxjc888.com:9602', '６╲７╲８╱积分换会员/无炮灰/稳定长久'),
(46, '１０倍经验１０／１１／１３点，只售强化恶魔一种道具！', 1382961600, '10', '1.03H', '极速双线', '2782055040', 'www.hbhdm.net', '１０倍经验１０／１１／１３点，只售强化恶魔一种道具！'),
(47, '&nbsp;５/６/７点１.０２Ｗ/巨资打造/长久稳定/无会员', 1382967000, '20-40倍', '1.02W', '极速双线', '2390121731', 'www.158mu.com', '５/６/７点１.０２Ｗ/巨资打造/长久稳定/无会员'),
(48, '&nbsp;999倍|50转|爆顶级|爆大天|x店卖旗|3年品牌', 1383049800, '999倍', '1.03', '极速双线', '981526201', 'www.268mu.com', '999倍|50转|爆顶级|爆大天|x店卖旗|3年品牌'),
(49, '品牌６万４／自由骑马／自由３Ｄ／６大Ｂｏｓｓ／Ｖip封挂', 1382973240, '500倍', '1.03H', '极速双线', '3801149', 'www.2010qj.com', '品牌６万４／自由骑马／自由３Ｄ／６大Ｂｏｓｓ／Ｖip封挂'),
(50, '满点１万２／Ｂoss集中营／高级技师／罗兰-魔炼／封挂', 1382963700, '200', '1.03H', '极速双线', '32949989', 'www.wyyx.cc', '满点１万２／Ｂoss集中营／高级技师／罗兰-魔炼／封挂'),
(51, '小退８Ｗ４一键暴击,独家无炮灰设置,自由镶嵌,人气火爆', 1382973600, '小退满级', '一键暴击', '极速双线', '320935668', 'www.1718mu.com', '小退８Ｗ４一键暴击,独家无炮灰设置,自由镶嵌,人气火爆'),
(52, '本站可以自由的免费的发布奇迹私服信息，欢迎各位GM发布。', 0, NULL, NULL, NULL, NULL, NULL, NULL),
(53, '<p><span style="color: rgb(43, 43, 43); font-family: Arial, 宋体; font-size: 14px; line-height: 26px;">　历经十年，奇迹(MU)饱经沧桑。十年前的奇迹是一群人坐船出发，到了勇者大陆。十年之后似乎一切又回到了原点。又是一群人坐船出发了，只是目的地变了，这次是神秘的阿卡伦，当然了船上的人也变了……唯一不变的大约只有我们这些对MU满怀激情的人吧。<br /><img src="http://images.17173.com/2013/mu//2013/03/25/20130325150258449.png" alt="奇迹mu" /><br /><img src="http://images.17173.com/2013/mu//2013/03/25/20130325150258873.png" alt="EX700" /><br /></span></p>', 0, NULL, NULL, NULL, NULL, NULL, NULL),
(54, '<div>曾经,有个游戏叫奇迹......</div><div>　　夏夜,月明星稀.银杏树下,一位老人对他的孙子讲述着一个故事...</div><div>　　爷爷：</div><div>　　“曾经,有个网络公司叫九城...代理着一款游戏—奇迹MU，在那中国网游处于空白的年代,中国网吧沸腾了...打个比方吧:你的网吧可以没有任何游戏,但不能没有奇迹...</div><div>　　曾经..每天在网吧一顿饭只吃一个面包还舍不得买一瓶水，因为水=一个小时的上网费...</div><div>　　曾经...有个荒唐的想法，愿用一年的生命换一把卓越传说杖..</div><div>　　曾经...有这样一则新闻，一个女孩用贞操换取一套+11女神装..</div><div>　　曾经..有过这样的悲剧，一个大学生在网吧连续玩奇迹N天N夜,瘁死于网吧..</div><div>　　曾经..也有让人羡慕的姻缘，相恋于奇迹，现实中步入婚姻圣殿...</div><div>　　曾经...现实中多少械斗源于奇迹...</div><div>　　曾经...因为奇迹发生的事情太多太多，奇迹改变了多少人的命运...”</div><div>　　孙子：</div><div>　　奇迹里到底有些什么?让这么多人为之疯狂?</div><div>　　爷爷：</div><div>　　“2D半的华丽画面+简单的操作打宝系统而已!!!但是它拥有让人热血沸腾的PK系统，能让男人疯狂女人心动的PK系统。。。人们就是喜欢它的简单美。。。</div><div>　　奇迹呀奇迹...勇者大陆—仙踪林—冰风谷—地下城—亚特兰蒂斯—失落之塔—死亡沙漠—天空之城!</div><div>　　曾经。。。战士这样的装束足以令人羡慕：身穿龙王套。手持真红剑。戴上恶魔小飞飞。颈挂卓越1击项链。手套减伤戒指。。。</div><div>　　曾经。。。MM是令人尊敬的，他会无偿的主动的为你释放治愈术;“++++++”久违的口号。。。</div><div>　　曾经。。。法师是这样练级的，他会冰封+瞬移+爆炎，然后再带着MM去升级。。。</div><div>　　曾经。。。魔剑士最帅的。既有法师的优雅又有战士的霸气。。。。</div><div>　　曾经。。。奇迹是需要配合的。。。</div><div>　　曾经。。。奇迹地图的每个角落都会出现玩家。。。</div><div>　　曾经。。。蹲点练级是要要画分界线的，同时还要不停喊：有人了，请让让。。。</div><div>　　曾经。。。宝石是异常珍贵的，每次听到那清脆的“叮”的一声，是多么的让人激动万分。</div><div><div>　曾经。。。PK是非常讲究经验和技术的。。。</div><div>　　曾经可以站安全区几个小时喊：卓越传说换卓越龙王啦。。。。</div><div>　　曾经在大陆，上线一个晚上光喊：石头收飞飞啦，有的带价来，为的就是能带上帅气的飞飞感受在空中飞翔的乐趣。</div><div>　　曾经在死亡沙漠连守2个月，就为了打赤炎魔爆本毁灭烈焰或毁灭杖。。</div><div>　　曾经有人+11龙王一套，全服的人都羡慕的不得了，所有人都速度飞回城里，只为一睹极品装备的风采;</div><div>　　曾经为了攒钱合装备，几个礼拜捡垃圾东西卖钱的人;</div><div>　　曾经为了拿把破坏耍酷，辛苦了5个月，攒齐了30颗生命，终于拿上，站安全区好几</div><div>　　个晚上的人;</div><div>　　曾经为了刷把毁灭杖给朋友，一次一次冲在死亡沙漠的前线，在天空之城独闯，在怪物群中屡挂屡往的人;</div><div>　　曾经在练级过程中见个MM路过,高兴得冲上前去大喊&quot;++++++++++++++++++&quot;的人;</div><div>　　曾经在沙漠打了把卓越复活，激动得好几天没睡好觉的人;</div><div>　　曾经和一个工会的人去天空之城，打天魔爆了把屠龙，自己拾上就回城，心砰砰砰直跳半天的人;</div><div>　　曾经和朋友们费尽千辛万苦，一起凑钱建个行会，没有尊卑之分;</div><div>　　曾经利用九城BUG找神秘商店赚钱的人;</div><div>　　曾经闯进那个转来转去却转不出去的地下城里练级，直到武器坏了，衣服烂了，依然转不出去的人;</div><div>　　曾经求着会里的大哥们带自己去死亡沙漠,不为打装备,只想看看赤炎魔长得什么样子的人;</div><div>　　曾经包里放着几个+9亮闪闪的装备不舍得用,等PK时才拿出来的人;</div><div>　　曾经相信骗子可以复制装备被骗了东西欲哭无泪的人;</div><div>　　曾经小战士为穿上龙王而狂冲三十三级的人;</div><div>　　曾经为了打一只火龙王而跟一大群人抢着打第一下人;</div><div>　　曾经和人PK的时候故意把翅膀拿下来，为了耍大牌而被人挂掉的人;</div><div>　　曾经见到红名的魔头马上就闪的人;</div><div>　　曾经见到安全区有人卖传说就M他问&quot;大哥,传说是什么?&quot;的人;</div><div>　　曾经200级还没带上小翅膀的人;</div><div>　　曾经花RMB买了石头,为了把装备砸到发亮人;</div><div>　　曾经打爆件装备被别人拣了,二话不说直接送他回城的人;</div><div>　　曾经和自己心爱的人结婚,一大群兄弟站成心形，来参加婚礼的人;</div><div>　　曾经攒了很多石头,站在安全区喊:&quot;换点卡月卡,诚心的M&quot;的人;</div><div>　　曾经上班或上学偷偷溜出来去网吧等黄金部队来袭的人;</div><div>　　曾经在安全区大喊:&quot;玛雅换生命你加钱&quot;的人;</div><div>　　曾经看到行会招人去入会,而被告之装备不亮不要而郁闷的人;</div><div>　　曾经禁不住诱惑去合装备爆得一干二净的人;</div><div>　　曾经总在包里放上带幸运属性的装备,听说这样就可以增加爆率的人;</div><div>　　曾经打开那些安全区小号喊的网站,结果……的人;</div><div>　　如果你是曾经的一员，那现在你们在哪?</div><div>　　曾经。。。。。。</div><div>　　完!!!!!!</div><div>　　后悔玩奇迹吗?不后悔，虽然失去了很多，但真的不后悔...奇迹走向颠峰的时候，有我在，</div><div>　　奇迹能走向辉煌，有我的一份力...曾经，有个游戏叫，奇迹...我爱它...</div><div>　　九城，是奇迹让你起家，而你却毁了奇迹，你摸摸你的良心...外挂泛滥的不成样子却不整治。</div><div>　　。。。在我心中。。。亚特兰蒂斯永远是最漂亮的地图，毁灭烈焰永远是最后的技能。。。</div><div>　　希望我老了的时候，奇迹还在。。。我还可以用左手按1~2~3(1冰封2瞬移3爆炎4毁灭烈焰。。。绚丽的魔法啊。。。)用右手握住鼠标，再次跑遍MU大陆的每一个角落，去看望那些可爱的怪物...虫鸣鸟叫...蔚蓝清澈的海水...地下城的幽灵们过的可好...冰风谷有没有消融...赤炎魔您还是一如既往的嚣张吗?...还有...真的好想念你们...</div><div>　　曾经，有个游戏，叫奇迹。。。。。。。。。。。</div></div>', 0, NULL, NULL, NULL, NULL, NULL, NULL),
(55, '<p>奇迹汇致力于建设干净，无毒、不胁迫、不攻击、不扫服，自由的奇迹私服发布站。</p>', 0, NULL, NULL, NULL, NULL, NULL, NULL),
(56, '封挂设置 全新反外挂登录器，自动封一切外挂，打造绿色公平游戏环境！~<br />特色设置 X商店出售彩云兽PK无反伤更激情，变身女战士迷醉万人！~ 游戏设置 9999倍经验,大师500倍经验，100转,出生送20000点，每转420点,满转64000点!&nbsp;<br />商店设置 商店出售宝石,Npc出售+15全属性红龙级别装备!&nbsp;<br />宝箱设置 开放宝箱 商店出售+1-+5宝箱 各种Boss杀之不绝!&nbsp;<br />功能介绍 开放广告,在线泡点,X店卖极品,物品卖商店获积分!&nbsp;<br />游戏介绍 游戏中的宝石卖商店获得积分,X店内出售全属性翅膀&nbsp;<br />刷怪设置 大陆-&gt;地3-&gt;古-&gt;坎特鲁废墟2-&gt;坎遗址-&gt;冰霜-&gt;天空&nbsp;<br />高级技师 开放高级技师.合+15全属性装备.所有套装均可强化-7&nbsp;<br />游戏设置 终极BOSS爆极品全属装备武器 库拉王 美杜莎 困顿&nbsp;<br />冰霜巨蛛 冰霜巨蛛：6小时刷新一次，一次掉落十件紫色装备&nbsp;<br />新手设置 战士.圣送,法师等送4000点初始! 初转220级送5转<br />特色设置 本服开放玩家变身功能,法师冲转,满后变战士,完美PK&nbsp;<br />特色设置 玛雅=30,生命=70,灵魂=30，羽毛=30,创造=100分,直接卖商店即可&nbsp;<br />线路设置 全新版本S6-EP2,千兆独享双线,游戏独立登录,电信网通相互可见&nbsp;<br />游戏惩罚 禁用非法工具，恶意捣乱，散布负面信息，无警告封号&nbsp;<br />公平设置 请,进驻本服的家族自重!╭∩╮（︶︿︶）╭∩╮乞讨！', 1385743260, '9999', 'S6EP2', '极速双线', '2761571931', 'www.zf-ws.com', '满点6400，爆大天，VIP防挂，高级技师合成，变身女战'),
(57, '【土豪奇迹】103H低倍专区正式开启！<br />100倍 耐玩 稳定 不卡 全服无套装属性<br />一比一仿官方品质！独家设置！<br />全服所有顶级装备均可不花钱获得！<br />还等什么？来吧！<br />百倍经验 &nbsp;满点3.6W<br />网站：www.lmcxmu.com&nbsp;<br />客服：1394303787<br />推广5个群100人群5000积分10个群100人1W积分（外挂，客服群不算）<br />新区开服日期为：2014年01月27日晚上：19：00（外挂举报有奖）', 1390820400, '500', '103h', 'BGP多线', '345443066', 'www.lmcxmu.com', '【【【【3.6W商店宝箱爆全属】】】】');

-- --------------------------------------------------------

--
-- 表的结构 `dy_classtype`
--

CREATE TABLE IF NOT EXISTS `dy_classtype` (
  `tid` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `molds` char(20) NOT NULL,
  `pid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `classname` char(50) NOT NULL,
  `gourl` char(255) NOT NULL,
  `litpic` char(200) NOT NULL,
  `title` char(100) NOT NULL,
  `keywords` char(255) NOT NULL,
  `description` varchar(300) NOT NULL,
  `isindex` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `t_index` char(50) NOT NULL,
  `t_list` char(50) NOT NULL,
  `t_listimg` char(50) NOT NULL,
  `t_listb` char(50) NOT NULL,
  `t_content` char(50) NOT NULL,
  `listnum` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `htmldir` char(100) NOT NULL,
  `htmlfile` char(100) NOT NULL,
  `mrank` smallint(5) NOT NULL DEFAULT '0',
  `msubmit` smallint(5) NOT NULL DEFAULT '0',
  `orders` int(10) NOT NULL DEFAULT '0',
  `body` mediumtext NOT NULL,
  `mshow` tinyint(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`tid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

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

CREATE TABLE IF NOT EXISTS `dy_comment` (
  `cid` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `aid` mediumint(8) unsigned NOT NULL,
  `molds` char(20) NOT NULL,
  `isshow` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `body` text NOT NULL,
  `reply` text NOT NULL,
  `addtime` int(10) unsigned NOT NULL DEFAULT '0',
  `retime` int(10) unsigned NOT NULL DEFAULT '0',
  `user` char(30) NOT NULL,
  `ruser` char(30) NOT NULL,
  PRIMARY KEY (`cid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=55 ;

-- --------------------------------------------------------

--
-- 表的结构 `dy_custom`
--

CREATE TABLE IF NOT EXISTS `dy_custom` (
  `id` smallint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(200) NOT NULL,
  `dir` char(100) NOT NULL,
  `template` char(100) NOT NULL,
  `file` char(200) NOT NULL,
  `html` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `dy_custom`
--

INSERT INTO `dy_custom` (`id`, `name`, `dir`, `template`, `file`, `html`) VALUES
(3, 'Release', '', 'index.html', 'release.html', 1);

-- --------------------------------------------------------

--
-- 表的结构 `dy_fields`
--

CREATE TABLE IF NOT EXISTS `dy_fields` (
  `fid` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `molds` char(20) NOT NULL,
  `fieldsname` char(20) NOT NULL,
  `fields` char(20) NOT NULL,
  `fieldstype` char(20) NOT NULL,
  `fieldslong` smallint(5) unsigned NOT NULL DEFAULT '0',
  `selects` text NOT NULL,
  `fieldorder` int(10) NOT NULL DEFAULT '0',
  `issubmit` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `lists` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `fieldshow` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `types` text NOT NULL,
  PRIMARY KEY (`fid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- 转存表中的数据 `dy_fields`
--

INSERT INTO `dy_fields` (`fid`, `molds`, `fieldsname`, `fields`, `fieldstype`, `fieldslong`, `selects`, `fieldorder`, `issubmit`, `lists`, `fieldshow`, `types`) VALUES
(6, 'article', '开区时间', 'date', 'time', 0, '', 0, 1, 1, 1, '|1|2|3|'),
(7, 'article', '经验', 'empiric', 'varchar', 8, '', 0, 1, 1, 1, '|1|2|3|'),
(8, 'article', '版本', 'ver', 'varchar', 16, '', 0, 1, 1, 1, '|1|2|3|'),
(9, 'article', '网络线路', 'line', 'select', 0, 'BGP多线=BGP多线,极速双线=极速双线,中国电信=中国电信,中国网通=中国网通', 0, 1, 1, 1, '|1|2|3|'),
(10, 'article', '客服QQ', 'qq', 'varchar', 12, '', 0, 1, 1, 1, '|1|2|3|'),
(11, 'article', '官方网站', 'link', 'varchar', 100, '', 0, 1, 1, 1, '|1|2|3|'),
(12, 'article', '特色介绍', 'summary', 'text', 0, '', 1, 1, 1, 1, '|1|2|3|');

-- --------------------------------------------------------

--
-- 表的结构 `dy_funs`
--

CREATE TABLE IF NOT EXISTS `dy_funs` (
  `fid` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `funs` char(20) NOT NULL,
  `fundb` char(255) NOT NULL,
  `name` char(20) NOT NULL,
  `isshow` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `afiles` text NOT NULL,
  `version` char(20) NOT NULL,
  PRIMARY KEY (`fid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=37 ;

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

CREATE TABLE IF NOT EXISTS `dy_labelcus` (
  `id` smallint(5) NOT NULL AUTO_INCREMENT,
  `name` char(50) NOT NULL,
  `body` text NOT NULL,
  `type` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- 转存表中的数据 `dy_labelcus`
--

INSERT INTO `dy_labelcus` (`id`, `name`, `body`, `type`) VALUES
(4, '站长QQ', '1651691181', 1),
(5, '公告1', '奇迹汇致力于建设干净的发布站！', 1),
(6, '公告2', '客服QQ 请各位GM启用QQ在线状态，才能正常显示!', 1),
(7, '公告3', '品牌推荐位置还有空位，欢迎各位GM入驻!', 1),
(8, '公告4', '品牌推荐位置还有空位，欢迎各位GM入驻!', 1),
(9, '投诉邮箱', 'hanscto@gmail.com', 1);

-- --------------------------------------------------------

--
-- 表的结构 `dy_links`
--

CREATE TABLE IF NOT EXISTS `dy_links` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `taid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `orders` int(10) NOT NULL DEFAULT '0',
  `name` char(100) NOT NULL,
  `image` char(200) NOT NULL,
  `gourl` char(200) NOT NULL,
  `isshow` tinyint(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `dy_links`
--

INSERT INTO `dy_links` (`id`, `taid`, `orders`, `name`, `image`, `gourl`, `isshow`) VALUES
(1, 1, 0, 'DOYO建站', '', 'http://wdoyo.com', 1),
(2, 1, 0, '新浪', '', 'http://www.sina.com.cn', 1);

-- --------------------------------------------------------

--
-- 表的结构 `dy_linkstype`
--

CREATE TABLE IF NOT EXISTS `dy_linkstype` (
  `taid` smallint(5) NOT NULL AUTO_INCREMENT,
  `name` char(100) NOT NULL,
  PRIMARY KEY (`taid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `dy_linkstype`
--

INSERT INTO `dy_linkstype` (`taid`, `name`) VALUES
(1, '门户导航');

-- --------------------------------------------------------

--
-- 表的结构 `dy_member`
--

CREATE TABLE IF NOT EXISTS `dy_member` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `user` char(20) NOT NULL,
  `pass` char(32) NOT NULL,
  `email` char(100) NOT NULL,
  `gid` smallint(5) NOT NULL DEFAULT '1',
  `money` decimal(10,2) NOT NULL DEFAULT '0.00',
  `regtime` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- 转存表中的数据 `dy_member`
--

INSERT INTO `dy_member` (`id`, `user`, `pass`, `email`, `gid`, `money`, `regtime`) VALUES
(13, 'test', '778af09ce0b1760bb0dd0e7abef95984', 'admin@qq.com', 1, '0.00', 1432891527),
(14, 'test2', '6c46206a42bddf4feff9463b7ae0795b', 'test2@qq.com', 1, '0.00', 1382853510),
(15, 'xuhuenn', 'bc735b63b56ee113c075f9f16ce76f4d', '345443066@qq.com', 1, '0.00', 1390748473);

-- --------------------------------------------------------

--
-- 表的结构 `dy_member_field`
--

CREATE TABLE IF NOT EXISTS `dy_member_field` (
  `aid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`aid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `dy_member_field`
--

INSERT INTO `dy_member_field` (`aid`) VALUES
(13),
(14),
(15);

-- --------------------------------------------------------

--
-- 表的结构 `dy_member_file`
--

CREATE TABLE IF NOT EXISTS `dy_member_file` (
  `id` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `url` char(255) NOT NULL,
  `size` int(11) unsigned NOT NULL DEFAULT '0',
  `fields` char(20) NOT NULL,
  `hand` int(9) unsigned NOT NULL DEFAULT '0',
  `aid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `molds` char(20) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user` (`uid`,`url`,`size`,`fields`,`hand`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `dy_member_group`
--

CREATE TABLE IF NOT EXISTS `dy_member_group` (
  `gid` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(20) NOT NULL,
  `weight` int(11) NOT NULL DEFAULT '0',
  `audit` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `submit` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `filetype` char(255) NOT NULL,
  `filesize` int(10) unsigned NOT NULL DEFAULT '0',
  `fileallsize` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`gid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `dy_member_group`
--

INSERT INTO `dy_member_group` (`gid`, `name`, `weight`, `audit`, `submit`, `filetype`, `filesize`, `fileallsize`) VALUES
(1, '普通会员', 1, 0, 1, 'jpg,gif,jpeg,png', 200, 500);

-- --------------------------------------------------------

--
-- 表的结构 `dy_message`
--

CREATE TABLE IF NOT EXISTS `dy_message` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `tid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `isshow` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `title` char(100) NOT NULL,
  `addtime` int(10) unsigned NOT NULL DEFAULT '0',
  `retime` int(10) unsigned NOT NULL DEFAULT '0',
  `orders` int(10) NOT NULL DEFAULT '0',
  `user` char(30) NOT NULL,
  `body` text NOT NULL,
  `reply` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `orbye` (`orders`,`addtime`),
  KEY `article` (`isshow`,`tid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- 表的结构 `dy_message_field`
--

CREATE TABLE IF NOT EXISTS `dy_message_field` (
  `aid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`aid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `dy_molds`
--

CREATE TABLE IF NOT EXISTS `dy_molds` (
  `mid` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `molds` char(20) NOT NULL,
  `molddb` char(255) NOT NULL,
  `moldname` char(20) NOT NULL,
  `orders` int(10) NOT NULL DEFAULT '0',
  `t_index` char(50) NOT NULL,
  `t_list` char(50) NOT NULL,
  `t_listimg` char(50) NOT NULL,
  `t_listb` char(50) NOT NULL,
  `t_content` char(50) NOT NULL,
  `isshow` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `afiles` text NOT NULL,
  `version` char(20) NOT NULL,
  `sys` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`mid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- 转存表中的数据 `dy_molds`
--

INSERT INTO `dy_molds` (`mid`, `molds`, `molddb`, `moldname`, `orders`, `t_index`, `t_list`, `t_listimg`, `t_listb`, `t_content`, `isshow`, `afiles`, `version`, `sys`) VALUES
(1, 'article', 'article', '文章', 0, 'list_index.html', 'list.html', 'list_image.html', 'list_body.html', 'article.html', 1, '', '1.0', 1),
(6, 'message', 'message,message_field', '交互(留言)', 0, 'message.html', 'message.html', 'message.html', 'message.html', 'message.html', 0, 'doyo/admin/a_message.php,include/class/c_message.php,doyo/admin/template/message.html,doyo/admin/template/message_edit.html,doyo/message.php', '1.0', 0),
(2, 'product', 'product', '产品', 0, 'list_index.html', 'list.html', 'list_image.html', 'list_body.html', 'product.html', 0, '', '1.0', 1);

-- --------------------------------------------------------

--
-- 表的结构 `dy_product`
--

CREATE TABLE IF NOT EXISTS `dy_product` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `tid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `sid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `isshow` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `title` char(100) NOT NULL,
  `style` char(60) NOT NULL,
  `trait` char(20) NOT NULL,
  `gourl` char(255) NOT NULL,
  `htmlfile` char(100) NOT NULL,
  `htmlurl` char(255) NOT NULL,
  `addtime` int(10) unsigned NOT NULL DEFAULT '0',
  `hits` int(10) unsigned NOT NULL DEFAULT '0',
  `litpic` char(255) NOT NULL,
  `photo` text NOT NULL,
  `orders` int(10) NOT NULL DEFAULT '0',
  `price` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `mrank` smallint(5) NOT NULL DEFAULT '0',
  `mgold` int(10) unsigned NOT NULL DEFAULT '0',
  `keywords` char(200) NOT NULL,
  `description` char(255) NOT NULL,
  `user` char(30) NOT NULL,
  `usertype` tinyint(2) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `orbye` (`orders`,`addtime`),
  KEY `product` (`isshow`,`tid`,`trait`,`sid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- 表的结构 `dy_product_field`
--

CREATE TABLE IF NOT EXISTS `dy_product_field` (
  `aid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `body` mediumtext NOT NULL,
  PRIMARY KEY (`aid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `dy_special`
--

CREATE TABLE IF NOT EXISTS `dy_special` (
  `sid` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `molds` char(20) NOT NULL,
  `name` char(50) NOT NULL,
  `litpic` char(200) NOT NULL,
  `title` char(100) NOT NULL,
  `keywords` char(255) NOT NULL,
  `description` varchar(300) NOT NULL,
  `gourl` char(255) NOT NULL,
  `isindex` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `t_index` char(50) NOT NULL,
  `t_list` char(50) NOT NULL,
  `t_listb` char(50) NOT NULL,
  `listnum` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `htmldir` char(100) NOT NULL,
  `htmlfile` char(100) NOT NULL,
  `orders` int(10) NOT NULL DEFAULT '0',
  `body` mediumtext NOT NULL,
  `isshow` tinyint(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`sid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- 表的结构 `dy_traits`
--

CREATE TABLE IF NOT EXISTS `dy_traits` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(50) NOT NULL,
  `molds` char(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

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

CREATE TABLE IF NOT EXISTS `dy_update` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `version` char(10) NOT NULL,
  `newupdate` char(15) NOT NULL,
  `uptime` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
