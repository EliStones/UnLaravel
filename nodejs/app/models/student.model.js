const mongoose = require('mongoose')

const StudentSchema = mongoose.Schema({
    name: String,
    course: String,
    year: Number
}, {
    timestamps: true
});

module.exports = mongoose.model('Student', StudentSchema);