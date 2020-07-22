const Student = require('../models/student.model.js');

exports.create = (req,res) => {

    if (!req.body.name) {
        return res.status(400).send({
            message: "Student name cannot be empty"
        });
    }

    const student = new Student({
        name: req.body.name,
        course: req.body.course,
        year: req.body.year
    });

    student.save()
    .then(data => {
        res.send(data);
    }).catch(err => {
        res.status(500).send({
            message: err.message || "Error occurred while adding data"
        })
    })
};

exports.findAll = (req,res) => {
    Student.find()
    .then(student => {
        res.send(student);
    }).catch(err => {
        res.status(500).send({
            message: err.message || "Some error occurred whie getting the data"
        });
    });
};

exports.findOne = (req,res) => {
    Student.findById(req.params.studentId)
    .then(student => {
        if (!student) {
            return res.status(404).send({
                message: "Student not found with id "+ req.params.studentId
            });
        }
        res.send(student);
    }).catch(err => {
        if (err.kind === 'ObjectId') {
            return res.status(400).send({
                message: "Student not found with id "+ req.params.studentId
            });
        }

        return res.status(500).send({
            message: "Error retrieving student with id "+ req.params.studentId
        });
    });
};

exports.update = (req,res) => {
    // Validate Request
    if(!req.body.name) {
        return res.status(400).send({
            message: "Student details can not be empty"
        });
    }

    // Find Student and update it with the request body
    Student.findByIdAndUpdate(req.params.studentId, {
        name: req.body.name,
        course: req.body.course,
        year: req.body.year
    }, {new: true})
    .then(student => {
        if(!student) {
            return res.status(404).send({
                message: "Student not found with id " + req.params.studentId
            });
        }
        res.send(student);
    }).catch(err => {
        if(err.kind === 'ObjectId') {
            return res.status(404).send({
                message: "Student not found with id " + req.params.studentId
            });                
        }
        return res.status(500).send({
            message: "Error updating student with id " + req.params.studentId
        });
    });
};

exports.delete = (req,res) => {
    Student.findByIdAndRemove(req.params.studentId)
    .then(student => {
        if(!student) {
            return res.status(404).send({
                message: "Student not found with id " + req.params.studentId
            });
        }
        res.send({message: "Student deleted successfully!"});
    }).catch(err => {
        if(err.kind === 'ObjectId' || err.name === 'NotFound') {
            return res.status(404).send({
                message: "Student not found with id " + req.params.studentId
            });                
        }
        return res.status(500).send({
            message: "Could not delete student with id " + req.params.studentId
        });
    });
};