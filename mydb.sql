-- Adminer 4.8.1 MySQL 8.0.31 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `admin` (`id`, `name`, `email`, `password`) VALUES
(1,	'admin',	'admin@gmail.com',	'$2y$10$wjbS6PULtYI9xoB1njfNju2DUTjT1LSwIvhSzv0AllLwVkapbMxXG'),
(3,	'admin1',	'admin1@gmail.com',	'$2y$10$ZD/dacxY6hEgSg43FL2sHekt/Km9OEgoLrp2Y5VVDlbKskdZrbxve');

DROP TABLE IF EXISTS `articles`;
CREATE TABLE `articles` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `categoryId` int NOT NULL,
  `content` longtext NOT NULL,
  `publishDate` timestamp NOT NULL,
  `adminId` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `categoryId` (`categoryId`),
  CONSTRAINT `articles_ibfk_1` FOREIGN KEY (`categoryId`) REFERENCES `category` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `articles` (`id`, `title`, `categoryId`, `content`, `publishDate`, `adminId`) VALUES
(3,	'Deuba, Thapa file candidacy for parliamentary party leader post ',	1,	'Prime Serve and Nepali Congress President Sher Bahadur Deuba and party common secretary Gagan Thapa have recorded their designation for the post of parliamentary party pioneer on Tuesday. Both competitors come to the party’s parliamentary party office in Singha Durbar to record their designations. Congress senior pioneer Slam Chandra Poudel proposed Deuba for the post whereas Purna Bahadur Khadka favored the proposition. Moreover, Thapa’s designation was proposed by Shekhar Koirala and favored by party bad habit president Dhanraj Gurung, common secretary Bishwa Prakash Sharma and pioneer Pradeep Poudel. The party has slated the race for the parliamentary party for Wednesday from 8am to 10am. The party’s 89 newly-elected legislators are qualified to vote within the decision for parliamentary party pioneer. The candidates will require at slightest 45 votes to secure the post.',	'2022-12-20 14:12:06',	'admin'),
(4,	'Rajendra Lingden unanimously elected to parliamentary leadership of Rastriya Prajatantra Party  ',	1,	'Rajendra Lingden has been chosen the pioneer of the parliamentary party of the Rastriya Prajatantra Party. “The Parliamentary Party assembly of the RPP held at the party office in Dhumbarahi on Tuesday collectively chosen Lingden as the leader,” educated party representative Mohan Shrestha. RPP has won 14 seats, counting seven through the corresponding poll, within the November 20 surveys.',	'2022-12-20 15:12:05',	'admin'),
(5,	'Is Messi likely to return to Barcelona at the end of the season?',	2,	'How will Lionel Messi and Kylian Mbappe respond when they meet at Camp des Loges, the preparing ground of Paris Holy person Germain? After the most prominent last of a World Glass, Messi will line up with Mbappe and Neymar, who is still lamenting from Brazil’s exit. How the three geniuses will work together post the World Container presently that conditions have changed will be closely observed. Too of intrigued is long term of Messi. His contract with the Qatar-funded club lapses at the conclusion of the season. PSG is set to offer Messi a two-year contract, Goal.com detailed. When Messi joined PSG in 2021, the two year contract had an choice of an additional year. But taking after Messi winning the World Glass, PSG is likely to go all out to hold him. There has too been theory that Messi may return to Barcelona, the club which he joined at the age of 13 after he moved to Spain. A move to MSL group Associate Miami is additionally being talked approximately. The Miami group co-owned by David Beckham were near to marking a bargain with Messi, multiple reports have said.',	'2022-12-20 15:12:07',	'admin1'),
(6,	'Day after Greatest World Cup final: Qatar empties, leaving behind emptiness',	2,	'The night of Sunday never finished. Not for Lionel Messi and companions; not for their fans; not for any football fan, maybe not for the whole nation and the human mass that collected here. Indeed hours after the amusement was over, the reality of what had unfurled steadily sinking within, the swarm clung on. A few were within the stands, processing the tumult they had seen, a few waiting on to celebrate, maybe to induce a see of Messi or Mbappe one final time.',	'2022-12-20 15:12:49',	'admin1'),
(7,	'Elon Musk at Twitter: Who could replace him as chief executive?',	3,	'Elon Musk is considering his following steps after a Twitter survey inquiring in case he ought to step down as chief official. More than 17 million individuals had their say - with 57.5% voting yes - taking off the another self-evident address being, in case not Mr Musk, who? The very rich person, who has been at the rudder of the social stage since October, said he would stand by the comes about of the survey. But he has not made any declarations with respect to plans to take off his position. \"No one needs the work who can really keep Twitter lively,\" he tweeted taking after the survey.',	'2022-12-20 16:12:25',	'admin1'),
(8,	'Fortnite settles child privacy and trickery claims',	3,	'The maker of popular video game Fortnite has agreed to pay $520m (£427m) to resolve claims from US regulators that it violated child privacy laws and tricked users into making purchases.\r\n\r\nThe Federal Trade Commission (FTC) said the firm duped players with \"deceptive interfaces\" that could trigger purchases while the game loaded.\r\n\r\nIt also accused it of using \"privacy-invasive\" default settings.\r\n\r\nEpic Games blamed \"past designs\".\r\n\r\n\"No developer creates a game with the intention of ending up here,\" the company said. \"We accepted this agreement because we want Epic to be at the forefront of consumer protection and provide the best experience for our players.\"\r\n\r\nFortnite, a battle royale game that became a global sensation after its launch in 2017, has more than 400 million players around the world. The game is generally free to download, but makes money from in-game purchases of items such as costumes and dance moves.\r\n\r\nThe FTC said that the game, which matches strangers around the world for interactive battles, was aimed at children and teens, but despite that, its developers failed to comply with rules regarding parental consent - even after making changes to address internal and public concerns.\r\n\r\n\"As our complaints note, Epic used privacy-invasive default settings and deceptive interfaces that tricked Fortnite users, including teenagers and children,\" said FTC chair Lina Khan.\r\n\r\n\"Protecting the public, and especially children, from online privacy invasions and dark patterns is a top priority for the commission, and these enforcement actions make clear to businesses that the FTC is cracking down on these unlawful practices.\"\r\n\r\nThe FTC said Epic would pay $275m - a record penalty for the consumer watchdog - to resolve the claims it collected child and teen data without parental consent, and exposed children and teens to bullying and harassment by turning on voice and text communications by default.\r\n\r\nEpic Games agreed to change its privacy settings for teens and children, and have chat communications turned off by default.\r\n\r\nThe company will also pay a record $245m, to be used for refunds to customers, to settle a separate complaint about deceptive billing practices.\r\n\r\nThe FTC cited a \"counterintuitive, inconsistent, and confusing button configuration\" that led to hundreds of millions of dollars in unauthorised purchases.\r\n\r\nIt said the firm had resisted changing its design to add a separate confirmation step, worried that doing so \"would add \'friction\', \'result in a decent number of people second guessing their purchase\', and reduce the number of \'impulse purchases\'\", according to the complaint.\r\n\r\nIt said the company locked accounts of customers who disputed charges and \"purposefully obscured cancel and refund features to make them more difficult to find\".\r\n\r\nEpic said it had been making changes and the practices detailed in the FTC\'s complaints were \"not how Fortnite operates\".\r\n\r\n\"The laws have not changed, but their application has evolved and long-standing industry practices are no longer enough,\" the company said, adding that it hoped to offer a model for the rest of the industry.',	'2022-12-20 16:12:19',	'admin1'),
(9,	'Treasury Department delays electric vehicle tax credit guidance until March',	4,	'The Treasury Department is delaying plans to issue proposed guidance for the sourcing of electric vehicle batteries for federal tax incentives from the end of this month to March.  \r\n\r\nThe sourcing of materials and batteries for EVs is a major part of the Inflation Reduction Act’s federal tax credits of up to $7,500 for consumers, which was signed into law by President Joe Biden in August.\r\n\r\nThat means some electric vehicles that are not expected to comply with the new standards will continue to be eligible for the credits until the proposed guidance issued. Other non-battery elements of the IRA will still take effect Jan. 1, including new income caps for eligible buyers and restrictions on vehicle pricing.\r\n\r\nSome have argued the sourcing guidelines for vehicle materials are unrealistic given the current supply chain. Other countries and non-domestic automakers such as Hyundai have argued the rules should be defined more broadly to allow some exemptions.\r\n\r\nThe Treasury said late-Monday that it will issue the “anticipated direction of the critical mineral and battery component requirements” by the end of this month, and that nothing will take effect until the proposed guidance is issued in March.\r\n\r\nThe Inflation Reduction Act limits EV tax credits to vehicles assembled in North America and is intended to wean the U.S. off battery materials from China, which reportedly accounts for 70% of global supply of battery cells for the vehicles.\r\n\r\nFor a $3,750 critical minerals credit, the law states that 40% must be extracted or processed in the U.S. or in a country where the U.S. has a free-trade agreement, or from materials that were recycled in North America.\r\n\r\nCredit for the other $3,750 requires that at least 50% of battery components were manufactured or assembled in North America. The percentage requirements for both rise annually to reduce reliance on foreign countries.\r\n\r\nStarting Jan. 1, a tax credit will not be available to single individuals with a modified adjusted gross income of $150,000 or higher. The income cutoff is higher for others — $225,000 for heads of household and $300,000 for married couples who file a joint tax return.\r\n\r\nCars with a retail price of more than $55,000 also aren’t eligible, nor are vans, SUVs or trucks that cost $80,000 or more.',	'2022-12-20 16:12:04',	'admin1'),
(10,	'Bank of Japan shocks global markets with bond yield shift',	4,	'Worldwide markets were jarred overnight after the Bank of Japan out of the blue extended its target run for 10-year Japanese government bond yields , starting a sell-off in bonds and stocks around the world. The central bank caught markets off protect by tweaking its surrender bend control (YCC) approach to permit the abdicate on the 10-year Japanese government bond (JGB) to move 50 premise focuses either side of its 0% target, up from 25 premise focuses already, in a move pointed at padding the impacts of extended financial boost measures. In a arrangement explanation, the BOJ said the move was planning to “improve advertise working and energize a smoother arrangement of the whole surrender bend, whereas keeping up accommodative money related conditions.“ The central bank presented its surrender bend control component in September 2016, with the purposeful of lifting swelling toward its 2% target after a delayed period of financial stagnation and ultralow swelling.',	'2022-12-20 16:12:37',	'admin1'),
(11,	'Bill Gates: ‘Our grandchildren will grow up in a world that is dramatically worse off’ if we don’t fix climate change',	4,	'The idea of becoming a grandparent is emotional for Bill Gates to even write about.\r\n\r\n“I started looking at the world through a new lens recently — when my older daughter gave me the incredible news that I’ll become a grandfather next year,” Gates wrote in a letter published overnight on his personal blog, Gates Notes.\r\n\r\nGates’ 26-year-old daughter, Jennifer, and her husband, Nayel Nassar, are expecting their first baby in 2023.\r\n\r\n“Simply typing that phrase, ‘I’ll become a grandfather next year,’ makes me emotional,” wrote the 67-year-old billionaire philanthropist, who earned his fortune from co-founding Microsoft\r\n in the 1970s. “And the thought gives a new dimension to my work. When I think about the world my grandchild will be born into, I’m more inspired than ever to help everyone’s children and grandchildren have a chance to survive and thrive.”\r\n\r\nGates goes on to summarize the work his namesake philanthropic organization, the Gates Foundation, is doing for children living in global poverty, to improve education, pandemic preparedness, and the fights against polio and AIDS.\r\n\r\nGates also talks about the work he is doing to combat climate change, both through the Gates Foundation by supporting early stage climate companies with his investment firm, Breakthrough Energy Ventures.\r\n\r\nCurrent leaders’ response to climate change will impact future generations, which is the first point Gates makes in the section of his letter where he addresses climate change.\r\n\r\n“I can sum up the solution to climate change in two sentences: We need to eliminate global emissions of greenhouse gases by 2050,” Gates writes. “Extreme weather is already causing more suffering, and if we don’t get to net-zero emissions, our grandchildren will grow up in a world that is dramatically worse off.”',	'2022-12-20 16:12:51',	'admin1'),
(12,	'Dahal, Oli unchallenged as parliamentary party leaders  ',	1,	'While the issue of electing parliamentary party leader is heating up in the Nepali Congress that won 89 seats in the House of Representatives in the elections last month, there is an unusual silence in the other two major parties–the CPN-UML and the CPN (Maoist Centre).\r\n\r\n\r\nThe work execution committee of the Nepali Congress on Sunday announced a three-member committee to conduct the election of parliamentary party leader. The election is to be held on Wednesday.\r\n\r\nMaoist Centre chair Pushpa Kamal Dahal, who has never been challenged either as party chair or parliamentary party leader, has no plan to hold an election for the post. But he has already started lobbying other parties to support his bid for prime minister.\r\n\r\n\r\n“We will pick our parliamentary party leader soon,” said Shakti Basnet, the party’s deputy general secretary.\r\n\r\nAmong the parties, the Nepali Congress has a longstanding tradition of holding elections to make appointments in key party positions. But in the UML, such elections, observers say, are cosmetic and only those close to the leadership emerge victorious.\r\n\r\nAnd in the CPN (Maoist Centre), they don’t normally have elections, barring a few exceptions. Office bearers are handpicked by the chairman. The former rebel party joined parliamentary politics in 2007, but it has never held an election to pick parliamentary party leaders.\r\n\r\n\r\n\r\n',	'2022-12-20 16:12:01',	'admin');

DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `category` (`id`, `name`) VALUES
(1,	'Local News'),
(2,	'Sports'),
(3,	'Technology'),
(4,	'Business');

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `users` (`id`, `name`, `email`, `password`) VALUES
(1,	'Rupesh Thapa',	'rupesh@gmail.com',	'$2y$10$IOPBIr3GhUWccVgKSEhugOyS7C.hWE0AA4E89u//X0z4gBiEx.GXG'),
(89,	'umesh ',	'umesh@gmail.com',	'$2y$10$H80ydW2clNG5YvRBSEK1fuZr2F/w9xUdH55COpKzQJ7JH9gW3zT0O'),
(92,	'bezay',	'bezay@gmail.com',	'$2y$10$w1UPNP7VIslkM8M015d5y.4cYR4Pew13TGO8D46cGQfrsFzRN2EoC');

-- 2023-01-28 16:26:03