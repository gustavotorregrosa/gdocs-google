import React, { Component } from 'react'
import 'materialize-css/dist/css/materialize.min.css'
import M from 'materialize-css'

class Arquivos extends Component {

    enviaArquivos = (e) => {
        e.preventDefault()
        let arquivosRaw = document.getElementById("meu-input").files
        this.converteArrayArquivos(arquivosRaw).then(r => {
            console.log(r)
            fetch('http://gdoc-ms.test/salvaarquivos', {
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                method: 'post',
                body: JSON.stringify({
                    arquivosFotos: r
                })
                // body: {
                //     hoje: "sexta-feira",
                //     arquivos: r
                // }
            })
        })
    }

    converteUnit = f => new Promise(sucesso => {
        const reader = new FileReader()
        reader.readAsDataURL(f)
        reader.onload = () => sucesso(reader.result)
    })

    converteArrayArquivos = arquivos => new Promise(sucesso => {
        let arquivosConvertidos = []
        let arquivosArray = Array.from(arquivos)
        arquivosArray.map((a) => {
            this.converteUnit(a).then(r => {
                let arqTemp = {
                    name: a.name,
                    type: a.type,
                    base64: r
                }
                arquivosConvertidos.push(arqTemp)
            })
        })
        // console.log("imprimindo arquivosConvertidos")
        // console.log(arquivosConvertidos)
        // sucesso("passei sim...")
        sucesso(arquivosConvertidos)
    })

    render() {
        return (
            <div className="container">
                <div className="row">
                    <div className="col s6">
                        <form action="#">
                            <div className="file-field input-field">
                                <div className="btn">
                                    <span>File</span>
                                    <input id="meu-input" type="file" multiple />
                                </div>
                                <div className="file-path-wrapper">
                                    <input className="file-path validate" type="text" placeholder="Upload one or more files" />
                                </div>
                            </div>


                        </form>
                    </div>
                    <div className="col s1">
                        <a onClick={e => this.enviaArquivos(e)} className="waves-effect waves-teal btn-flat">Enviar</a>
                    </div>
                </div>
            </div>

        )
    }
}

export default Arquivos
