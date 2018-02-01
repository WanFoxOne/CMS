SELECT nc.content_id AS content_id, nc.content_type AS content_type, `nc.number` AS content_number, ct.text AS content_text
FROM node_content nc
JOIN content_text ct ON nc.content_type='text' AND ct.content_id=nc.content_id AND ct.locale='fr'
WHERE nc.node_id=1
ORDER BY `nc.number`;

