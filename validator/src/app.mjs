import express from "express"
import dotenv from "dotenv"
dotenv.config()
const app = express()
const PORT = process.env.APP_PORT

import dbconnection from "../connection/connection.mjs"

setInterval(function() {
    const viewQuery = `CALL smart_ReportView`
    
    dbconnection.query(viewQuery, (err, result) => {
        if (err) {
            throw err
        }
        const rows = result[0]
        rows.forEach(row => {
            console.log("Date End:", row.date_end)
            const dateEnd = new Date(row.date_end)
            console.log("Parsed Date End:", dateEnd)
            const currentDate = new Date();
            if (currentDate >= dateEnd) {
                const account_id = row.account_id
                const locker_id = row.locker_id
                const updateViewQuery = `CALL smart_lockerServiceExpire(?,?)`
                dbconnection.query(updateViewQuery, [account_id, locker_id], (err, response) => {
                    if(err) {   
                        throw err
                    }

                    const res = response[0]
                    res.forEach(res => {
                        const email = res.email
                        const phone = res.phone
                        console.log(`Time's up for locker ${email} ${phone}!`)
                    })
                })
            }
        })
    })
}, 1000)


  

app.listen(PORT, ()=> {
    try
    {
        dbconnection.connect((err) => {
            if(err)
                throw err
            console.log(`App is connected to DB ${process.env.APP_DATABASE} PORT ${PORT}`)
        })
    }
    catch(err)
    {
        console.error(`Detected error in ${err}`)
    }
})