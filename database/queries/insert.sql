INSERT INTO `USER` (`verification`, `firstname`, `lastname`, `email`, `password`, `accountType`) VALUES
  ('50e1c42638098417b68d1f4f6a0a107b', 'kokos', 'kokou', 'a@a.com', '12', 'ADMIN'),
  ('4cd8c563c7fd2a927e4447ac92553a42', 'andros', 'xampou', 'a@a.com', '33', 'ADV'),
  ('50abfd54643e199edfec382a2d4d021b', 'koullis', 'xatzis', 'a@a.com', '44', 'UNKNOWN')
;

INSERT INTO `USER` (`verification`, `firstname`, `lastname`, `email`, `password`, `accountType`) VALUES
  ('50e1c42638098417b68d1f4f6a2a107e', 'Panayiotis', 'Pavlides', 'pavlides_13@hotmail.com', '11', 'ADV')
;

INSERT INTO `MODEL` (`id`, `title`) VALUES
(1, 'BRNNE-BPTT');


INSERT INTO `LOGFILE` (`token`, `user_id`, `start_timestamp`, `end_timestamp`) VALUES
('50e1c42638098417b68d1f4f6a2a107e', 'pavlides_13@hotmail.com', '1470304577', '1470304673'),
('4cd8c563c7fd2a927e4447ac92553a42',  'pavlides_13@hotmail.com', '1470304578', '1470304580');

INSERT INTO `PENDING_RESULTS` (`verification`, `firstname`, `lastname`, `email`, `password`, `accountType`) VALUES
  ('50e1c42638098417b68d1f4f6a2a107e', 'Panayiotis', 'Pavlides', 'pavlides_13@hotmail.com', '11', 'ADV')
;
