

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


CREATE TABLE `tbladmin` (
  `AID` int(11) NOT NULL,
  `Fjalekalimi` varchar(25) DEFAULT NULL,
  `Privilegji` int(11) NOT NULL DEFAULT '2'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


INSERT INTO `tbladmin` (`AID`, `Fjalekalimi`, `Privilegji`) VALUES
(1, 'islamquiz', 1);

CREATE TABLE `tblorder` (
  `ID` int(11) NOT NULL,
  `query` varchar(300) NOT NULL,
  `order_only` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


INSERT INTO `tblorder` (`ID`, `query`, `order_only`) VALUES
(1, 'select PID from tblpyetja where aktive=1 order by case when kategoria=1 then 3 when kategoria=2 then 4 when kategoria=3 then 1 when kategoria=4 then 2 when kategoria=5 then 5 end', '3,4,1,2,5');


CREATE TABLE `tblpyetja` (
  `PID` int(11) NOT NULL,
  `txtPyetjes` varchar(500) NOT NULL,
  `alternativat` varchar(560) DEFAULT NULL,
  `pSakte` varchar(140) NOT NULL,
  `fotoLocation` varchar(150) DEFAULT NULL,
  `aktive` tinyint(1) NOT NULL DEFAULT '1',
  `kategoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


ALTER TABLE `tbladmin`
  ADD PRIMARY KEY (`AID`);

ALTER TABLE `tblorder`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `tblpyetja`
  ADD PRIMARY KEY (`PID`);

ALTER TABLE `tbladmin`
  MODIFY `AID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

ALTER TABLE `tblpyetja`
  MODIFY `PID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=122;