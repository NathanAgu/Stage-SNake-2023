<style type="text/css">

.item
{
    margin: 20px;
}

/* ========================= Input-Box ========================= */

.inputBox 
{
    position: relative;
    align-items: center;
    display: flex;
    height: 35px;
    width: 300px;
    transition: 0.3s;
}

.inputBox input
{
    position: relative;
    display: flex;
    background: none;
    height: 100%;
    width: 100%;
    padding: 0 10px;
    border: 2px solid #777;
    border-radius: 5px;
    border-top-left-radius: 0;
    border-bottom-right-radius: 0;
    outline: none;
}

.inputBox i 
{
    height: 15px;
    position: absolute;
    left: 0;
    margin: 10px;
    font-style: normal;
    color: #777;
    transition: 0.3s;
    pointer-events: none;
}

.inputBox input:focus,
.inputBox input:valid
{
    border: 2px solid #3366cc;
}

.inputBox input:focus ~ i,
.inputBox input:valid ~ i 
{
    transform: translateY(-19px);
    background: #fff;
    padding: 0 4px;
    font-size: 0.8em;
    color: #3366cc;
    border-radius: 100px;
}

/* ======================== Submit-Box ======================== */

.submitBox
{
    position: relative;
    align-items: center;
    display: flex;
    height: 35px;
    width: 300px;
    transition: 0.3s;
}

.submitBox input
{
    position: relative;
    display: flex;
    justify-content: center;
    background: #fff;
    height: 100%;
    width: 100%;
    font-size: 1em;
    padding: 0 10px;
    color: #40cc33;
    border: 2px solid #40cc33;
    border-radius: 5px;
    border-top-left-radius: 0;
    border-bottom-right-radius: 0;
    outline: none;
}

.submitBox input:hover 
{
    background: #40cc33;
    color: #fff;
    transition: 0.3s;
}

/* ====================== Nav-Btn generic ====================== */

.navG-btn 
{
    display: flex;
    flex-direction: row;
    height: 25px;
    width: auto;
    margin: 5px;
    border-radius: 5px;
}

.navG-btn .icon
{
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100%;
    width: 25%;
}

.navG-btn p {
    display: flex;
    align-items: center;
    height: 100%;
    width: 75%;
    margin: 0;
    padding: 0 20px;
    color: #000;
}

.navG-btn:hover
{
    background: #00000025;
    transition: 0.3s;
}

/* ====================== Doc-Btn ====================== */

.doc-btn
{
    display: flex;
    height: 125px;
    width: 125px;
    background: #fff;
    border: 1px solid #777;
    border-radius: 5px;
}

.doc-btn:hover 
{
    background: #3366cc50;
    border: 1px solid #3366cc;
}

.doc-btn button 
{
    height: 100%;
    width: 100%;
    background: none;
    border: none;
    font-size: 1em;
    font-weight: bold;
}

.doc-btn:hover button
{
    color: #3366cc;
}

/* ====================== cl-Btn ====================== */

.cl-btn
{
    display: flex;
    height: 35px;
    width: 150px;
    background: #fff;
    border: 2px solid #3366cc;
    border-radius: 5px;
    border-top-left-radius: 0;
    border-bottom-right-radius: 0;
}

.cl-btn button {
    position: relative;
    height: 100%;
    width: 100%;
    color: #3366cc;
    font-size: 1em;
    background: none;
    border: none;
    transition: 0.3s;
    z-index: 2;
    overflow: hidden;
}

.cl-btn button:hover {
    color: white;
    width: 150px;
}

.cl-btn button::before {
    content: "";
    position: absolute;
    height: 50px;
    width: 200px;
    border-radius: 5px;
    background-color: #3366cc;
    top: -2px;
    left: -2px;
    transform: translate(-100%);
    transition: 0.3s;
    z-index: -1;
}

.cl-btn button:hover::before {
    transform: translate(0%);
}
</style>