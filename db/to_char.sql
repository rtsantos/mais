CREATE FUNCTION `TO_CHAR` (p_date DATE, p_mask VARCHAR, p_lang VARCHAR) 
RETURN VARCHAR(200)
BEGIN
   DECLARE v_mask VARCHAR;
   DECLARE v_result VARCHAR;

   
   v_mask = UPPER(p_mask);
   
   v_mask = REPLACE(v_mask, 'RRRR', '%Y');
   v_mask = REPLACE(v_mask, 'RR', '%y');
   v_mask = REPLACE(v_mask, 'YYYY', '%Y');
   v_mask = REPLACE(v_mask, 'YY', '%y');
   v_mask = REPLACE(v_mask, 'MM', '%m');
   v_mask = REPLACE(v_mask, 'DD', '%d');
   v_mask = REPLACE(v_mask, 'HH24', '%H');
   v_mask = REPLACE(v_mask, 'HH12', '%h');
   v_mask = REPLACE(v_mask, 'HH', '%h');
   v_mask = REPLACE(v_mask, 'MI', '%i');
   v_mask = REPLACE(v_mask, 'SS', '%s');
   v_mask = REPLACE(v_mask, 'MON', '%b');
   v_mask = REPLACE(v_mask, 'MONTH', '%M');
   v_mask = REPLACE(v_mask, 'DAY', '%DY');
   
   v_result = DATE_FORMAT(p_date, v_mask);
   
   RETURN v_result;
END