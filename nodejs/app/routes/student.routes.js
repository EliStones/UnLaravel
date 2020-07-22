module.exports = (app) => {
    const students = require('../controllers/student.controller.js');

    app.post('/api/v1/students', students.create);

    app.get('/api/v1/students', students.findAll);

    app.get('/api/v1/students/:studentId', students.findOne);

    app.put('/api/v1/students/:studentId', students.update);

    app.delete('/api/v1/students/:studentId', students.delete);
    
}