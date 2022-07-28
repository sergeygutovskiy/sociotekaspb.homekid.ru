import SwaggerUI from 'swagger-ui';
import 'swagger-ui/dist/swagger-ui.css';

const spec = require('./swagger/swagger.yaml');

const ui = SwaggerUI({
  spec,
  dom_id: '#swagger',
});

ui.initOAuth({
  appName: "Swagger UI",
  clientId: 'implicit',
});