<style type="text/css">
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
/* ================================================================ */
/*      General                                                     */
/* ================================================================ */

*, ::after, ::before
{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    scroll-behavior: smooth;
    text-decoration: none;
    list-style: none;
    font-family: 'Poppins', sans-serif;
}

html, body
{
    height: 100%;
}

button
{
    background: none;
    border: none;
}

/* ================================================================ */
/*      Header                                                      */
/* ================================================================ */

header
{
    position: fixed;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    height: 100%;
    max-height: 100vh;
    width: 90px;
    padding: 10px 0;
    background: #fff;
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.3);
    transition: 0.5s;
    overflow: hidden;
    z-index: 1000;
}

header.active
{
    width: 240px;
    transition: 0.5s;
}

header .navDoc
{
    display: none;
    max-height: calc(100vh - 310px);
    margin: 10px 0;
    overflow: scroll;
}

header.active .navDoc
{
    display: block;
}

header .navDoc ul
{
    margin: 10px 0;
}

header .navButton
{
    display: flex;
    height: 40px;
    width: 240px;
    margin: 5px 0;
    background: #fff;
    transition: 0.5s;
}

header .navButton:hover
{
    background: #ddd;
    transition: 0.5s;
}

header .title:hover
{
    background: none;
}

header .navDocBtn
{
    margin: 0;
}

header .docBtn
{
    display: none;
    height: 30px;
}

header .docTitle
{
    font-weight: 600;
}

header .docActive
{
    display: flex;
}

header .navButton a
{
    height: 100%;
    width: 100%;
}

header .navButton a.set
{
    width: 25px;
}

header .navButton button
{
    display: flex;
    align-items: center;
    height: 100%;
    width: 100%;
    font-size: 1em;
}

header .navDocBtn button
{
    padding-left: 10px;
}

header .docBtn button
{
    padding-left: 20px;
}

header .navButton button.name
{
    width: 205px;
}

header .navButton button.settings
{
    justify-content: center;
    width: 25px;
    padding: 0;
}

header .navButton a.set button.settings
{
    display: none;
}

header .navButton:hover a.set button.settings
{
    display: flex;
}

header .navButton button img
{
    height: 60%;
    width: 60%;
}

header .navButton button img.icon
{
    height: 30px;
    width: 30px;
    margin: 0 30px;
}

header .navButton button span
{
    display: none;
    margin: 10px 0;
    color: #000;
    font-size: 1em;
    transition: 0.5s;
}

header .title button span
{
    font-size: 1.5em;
    font-weight: 600;
}

header.active .navButton button span
{
    display: inline-block;
}

/* ===================== Page ===================== */

main
{
    max-width: 1920px;
    padding-left: 240px;
}

main .content
{
    display: flex;
    flex-direction: column;
    padding: 100px 100px 0 100px;
}

main .formPage
{
    height: 100vh;
    flex-direction: row;
    justify-content: center;
    align-items: center;
    padding: 0;
}

main .content .form
{
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    height: 400px;
    width: 400px;
    margin: 50px;
}

main .content .svg
{
    height: 500px;
    width: 500px;
}

::-webkit-scrollbar {
    height: 0;
    width: 5px;
    background-color: #ffffff;
}

::-webkit-scrollbar-thumb {
    background-color: #999999;
    backdrop-filter: blur(1px);
}
</style>