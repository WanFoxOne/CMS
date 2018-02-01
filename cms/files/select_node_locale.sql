SELECT nloc.name AS node_name, nloc.title AS node_title, nloc.abstract AS node_abstract, nloc.cloud AS node_cloud, n.user_id AS node_user, n.created AS node_created, n.modified AS node_modified
FROM node n
JOIN node_locale nloc ON nloc.node_id=n.node_id AND nloc.locale='fr'
WHERE n.node_id=1
LIMIT 1;

